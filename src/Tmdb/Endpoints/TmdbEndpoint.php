<?php

namespace Kiwilan\Tmdb\Endpoints;

use App\Engines\PosterParser;
use App\Facades\Kiwiflix;
use App\Jobs\Tmdb\TmdbMemberJob;
use App\Models\Collection as ModelsCollection;
use App\Models\Company;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Movie;
use App\Models\Network;
use App\Models\Season;
use App\Models\TvShow;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Kiwilan\HttpPool\HttpPool;
use Kiwilan\HttpPool\Response\HttpPoolResponse;
use Kiwilan\LaravelNotifier\Facades\Journal;
use Kiwilan\Tmdb\Models\TmdbCrew;
use Kiwilan\Tmdb\Models\TmdbGenre;
use Kiwilan\Tmdb\Models\TmdbNetwork;
use Kiwilan\Tmdb\Models\TmdbProductionCompany;
use Kiwilan\Tmdb\Models\TmdbProductionCountry;
use Kiwilan\Tmdb\Models\TmdbSpokenLanguage;

/**
 * The Movie Database API
 *
 * @see https://developer.themoviedb.org/docs/getting-started
 */
abstract class TmdbEndpoint
{
    protected string $baseURL = 'https://api.themoviedb.org/3';

    protected Movie|TvShow|Season|ModelsCollection $model;

    /**
     * @param  TmdbCrew[]  $cast
     * @param  TmdbCrew[]  $crew
     */
    public static function addAllMembers(?array $cast, ?array $crew, Movie|TvShow|Season|Episode $model): void
    {
        if (! $cast && ! $crew) {
            return;
        }

        TmdbMemberJob::dispatch($model, $cast, $crew);
    }

    /**
     * @param  TmdbGenre[]  $genres
     */
    protected function genres(array $genres): void
    {
        if (! $genres) {
            return;
        }

        $this->model->genres()->detach();

        foreach ($genres as $genre) {
            $mg = Genre::query()
                ->firstOrCreate([
                    'tmdb_id' => $genre->id,
                    'name' => $genre->name,
                ]);

            $this->model->genres()->attach($mg);
        }
    }

    /**
     * @param  TmdbProductionCompany[]  $companies
     */
    protected function companies(array $companies): void
    {
        $this->model->companies()->detach();

        $items = [];
        foreach ($companies as $company) {
            $items[] = Company::query()
                ->firstOrCreate([
                    'tmdb_id' => $company->id,
                ], [
                    'name' => $company->name,
                    'logo_tmdb' => $this->parseImageUrl($company->logo_path),
                    'origin_country' => $company->origin_country,
                ]);
        }
        $this->model->companies()->sync(array_map(fn ($item) => $item->id, $items));
    }

    /**
     * @param  TmdbProductionCountry[]  $countries
     */
    protected function countries(array $countries): void
    {
        $this->model->countries()->detach();

        $items = [];
        foreach ($countries as $country) {
            $items[] = Country::query()
                ->firstOrCreate([
                    'iso_3166_1' => $country->iso_3166_1,
                ], [
                    'name' => $country->name,
                ]);
        }
        $this->model->countries()->sync(array_map(fn ($item) => $item->id, $items));
    }

    /**
     * @param  TmdbSpokenLanguage[]  $languages
     */
    protected function languages(array $languages): void
    {
        $this->model->languages()->detach();

        $items = [];
        foreach ($languages as $language) {
            $items[] = Language::query()
                ->firstOrCreate([
                    'iso_639_1' => $language->iso_639_1,
                ], [
                    'name' => $language->name,
                ]);
        }
        $this->model->languages()->sync(array_map(fn ($item) => $item->id, $items));
    }

    /**
     * @param  TmdbNetwork[]  $networks
     */
    protected function networks(array $networks): void
    {
        $this->model->networks()->detach();

        $items = [];
        foreach ($networks as $network) {
            /** @var ?Network */
            $nw = Network::query()
                ->firstOrCreate([
                    'tmdb_id' => $network->id,
                ], [
                    'name' => $network->name,
                    'logo_tmdb' => $this->parseImageUrl($network->logo_path),
                    'origin_country' => $network->origin_country,
                ]);

            if (! $nw->logo) {
                PosterParser::make($nw);
            }

            $items[] = $nw;
        }

        if (method_exists($this->model, 'networks')) {
            $this->model->networks()->sync(array_map(fn ($item) => $item->id, $items));
        }
    }

    protected function title(string $title): string
    {
        $disallowed = ['{', '}', '«', '»', '“', '”', '’'];
        $title = str_replace($disallowed, '', $title);

        if (str_starts_with($title, '(')) {
            $disallowed = ['(', ')'];
            $title = str_replace($disallowed, '', $title);
        }

        return $title;
    }

    protected function slug(): ?string
    {
        if (! $this->model instanceof Movie && ! $this->model instanceof TvShow) {
            return null;
        }

        $slug = null;
        if ($this->model instanceof TvShow) {
            $slug = "{$this->model->title} {$this->model->year}";
        } elseif ($this->model instanceof Movie) {
            $slug = "{$this->model->title} {$this->model->year} {$this->model->edition}";
        }

        return Str::slug($slug);
    }

    protected function buildUrl(string $endpoint, array $params): string
    {
        foreach ($params as $name => $value) {
            if ($value) {
                $endpoint = str_replace("{{$name}}", urlencode($value), $endpoint);
            } else {
                $endpoint = str_replace("{$name}={{$name}}", '', $endpoint);
            }
        }

        while (str_ends_with($endpoint, '&') || str_ends_with($endpoint, '?')) {
            $endpoint = substr($endpoint, 0, -1);
        }

        return $endpoint;
    }

    public static function parseImageUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $urlPrefix = 'https://image.tmdb.org/t/p/original';

        return "{$urlPrefix}{$path}";
    }

    protected function fetchBody(string $url): ?array
    {
        $apiKey = Kiwiflix::tmdbApiKey();

        $client = new \GuzzleHttp\Client;
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => "Bearer {$apiKey}",
            ],
            'http_errors' => false,
        ]);
        $body = $response->getBody()->getContents();
        if (! $body) {
            return null;
        }

        $statusCode = $response->getStatusCode();
        if ($statusCode !== 200) {
            Journal::warning("Failed to fetch data from {$url}: {$statusCode}");
        }

        return json_decode($body, true);
    }

    /**
     * @return Collection<int, HttpPoolResponse>
     */
    protected function fetch(array $items): Collection
    {
        $verbose = Kiwiflix::useVerbose();
        $apiKey = Kiwiflix::tmdbApiKey();

        $pool = HttpPool::make($items)
            ->setHeaders([
                'Authorization' => "Bearer {$apiKey}",
            ]);

        if ($verbose) {
            $pool->allowPrintConsole();
        }

        $pool = $pool->execute();

        return $pool->getFullfilled();
    }
}
