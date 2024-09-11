<?php

namespace Kiwilan\Tmdb\Endpoints;

use App\Engines\PosterParser;
use App\Jobs\Tmdb\TmdbJob;
use App\Models\Collection as ModelsCollection;
use App\Models\Movie;
use Kiwilan\LaravelNotifier\Facades\Journal;
use Kiwilan\Tmdb\Models\TmdbAlternativeTitle;
use Kiwilan\Tmdb\Models\TmdbAlternativeTitleResult;
use Kiwilan\Tmdb\Models\TmdbCredits;
use Kiwilan\Tmdb\Models\TmdbMovie;
use Kiwilan\Tmdb\Models\TmdbMovieRecommendations;
use Kiwilan\Tmdb\Models\TmdbMovieReleaseDates;
use Kiwilan\Tmdb\Models\TmdbMovieSimilar;
use Kiwilan\Tmdb\Models\TmdbSearchMovie;

class TmdbMovieEndpoint extends TmdbEndpoint
{
    public function __construct(Movie $model)
    {
        $this->model = $model;

        if (! $this->model->tmdb_id) {
            $url = $this->buildUrl("{$this->baseURL}/search/movie?query={query}&primary_release_year={year}", [
                'query' => $model->title,
                'year' => $model->year,
            ]);
            $body = $this->fetchBody($url);
            if (! $body) {
                Journal::warning("No results for Movie {$model->title} ({$model->year})");
                $this->model->fetched_has_failed = true;
                $this->model->saveQuietly();

                return;
            }
            $this->searchConvert(new TmdbSearchMovie($body));
        }

        if (! $this->model->tmdb_id) {
            return;
        }
        $url = $this->buildUrl("{$this->baseURL}/movie/{tmdb_id}?append_to_response=alternative_titles,credits,release_dates,recommendations,similar", [
            'tmdb_id' => $this->model->tmdb_id,
        ]);
        $body = $this->fetchBody($url);
        $this->movieConvert(new TmdbMovie($body));
    }

    private function searchConvert(TmdbSearchMovie $tmdb)
    {
        if (empty($tmdb->results)) {
            return;
        }

        $first = array_shift($tmdb->results);

        $date = $first->release_date;
        $year = $first->release_date ? substr($first->release_date, 0, 4) : null;
        $this->model->updateNoSearch([
            'tmdb_id' => $first->id,
            'title' => $this->title($first->title),
            'year' => $year,
            'french_title' => null,
            'original_title' => $first->original_title,
            'release_date' => $date,
            'original_language' => $first->original_language,
            'overview' => $first->overview,
            'popularity' => $first->vote_average,
            'popularity_count' => $first->vote_count,
            'backdrop_tmdb' => $this->parseImageUrl($first->backdrop_path),
            'poster_tmdb' => $this->parseImageUrl($first->poster_path),
            'is_adult' => $first->adult,
            'fetched_at' => now(),
        ]);
    }

    private function movieConvert(TmdbMovie $tmdb)
    {
        if ($tmdb->original_language === 'fr') {
            $this->model->french_title = $this->title($tmdb->original_title);
        }

        $this->model->updateNoSearch([
            'tmdb_id' => $tmdb->id,
            'title' => $this->title($tmdb->title),
            'original_title' => $tmdb->original_title,
            'original_language' => $tmdb->original_language,
            'overview' => $tmdb->overview,
            'poster_tmdb' => $this->parseImageUrl($tmdb->poster_path),
            'backdrop_tmdb' => $this->parseImageUrl($tmdb->backdrop_path),
            'popularity' => $tmdb->vote_average,
            'popularity_count' => $tmdb->vote_count,
            'is_adult' => $tmdb->adult,
            'imdb_id' => $tmdb->imdb_id,
            'homepage' => $tmdb->homepage,
            'tmdb_url' => "https://www.themoviedb.org/movie/{$tmdb->id}",
            'release_date' => $tmdb->release_date,
            'runtime' => $tmdb->runtime,
            'budget' => $tmdb->budget,
            'revenue' => $tmdb->revenue,
            'status' => $tmdb->status,
            'tagline' => $tmdb->tagline,
            'fetched_at' => now(),
        ]);

        $isExists = Movie::query()
            ->where('slug', $this->slug())
            ->where('id', '!=', $this->model->id)
            ->first();

        if ($isExists instanceof Movie) {
            $isExists->delete();
        }

        $this->genres($tmdb->genres);

        if ($tmdb->belongs_to_collection && $tmdb->belongs_to_collection->id) {
            $c = ModelsCollection::query()->where('tmdb_id', $tmdb->belongs_to_collection->id)->first();
            if (! $c) {
                $c = new ModelsCollection([
                    'tmdb_id' => $tmdb->belongs_to_collection->id,
                ]);
                $c->saveNoSearch();
            }

            $c->updateNoSearch([
                'title' => $tmdb->belongs_to_collection->name,
                'poster_tmdb' => $this->parseImageUrl($tmdb->belongs_to_collection->poster_path), // 'https://image.tmdb.org/t/p/original/ogyw5LTmL53dVxsppcy8Dlm30Fu.jpg
                'backdrop_tmdb' => $this->parseImageUrl($tmdb->belongs_to_collection->backdrop_path),
                'added_at' => $this->model->added_at,
                'has_new_movie' => true,
            ]);

            $this->model->collection()->associate($c);

            TmdbJob::dispatch($c);
        }

        PosterParser::make($this->model);
        $this->alternativeTitlesConvert($tmdb->alternative_titles);
        $this->creditsConvert($tmdb->credits);
        $this->releaseDatesConvert($tmdb->release_dates);
        $this->recommendationsConvert($tmdb->recommendations);
        $this->similarConvert($tmdb->similar);

        $this->companies($tmdb->production_companies);
        $this->countries($tmdb->production_countries);
        $this->languages($tmdb->spoken_languages);

        $this->model->saveNoSearch();
    }

    private function alternativeTitlesConvert(TmdbAlternativeTitle $tmdb)
    {
        $items = $tmdb->titles;
        if (! $items) {
            return;
        }

        $item = array_filter($items, fn (TmdbAlternativeTitleResult $item) => $item->iso_3166_1 === 'FR');
        if ($item && ! $this->model->french_title) {
            $title = array_shift($item);
            $this->model->french_title = $title->title;
        }
    }

    private function creditsConvert(TmdbCredits $tmdb)
    {
        $this->addAllMembers($tmdb->cast, $tmdb->crew, $this->model);
    }

    private function releaseDatesConvert(TmdbMovieReleaseDates $tmdb)
    {
        $us = array_filter($tmdb->results, fn ($item) => $item->iso_3166_1 === 'US');
        if ($us) {
            $us = array_shift($us);
            $items = [];
            foreach ($us->release_dates as $item) {
                if ($item->certification) {
                    $items[] = $item;
                }
            }

            $certification = null;
            foreach ($items as $item) {
                if ($item->certification) {
                    $certification = trim($item->certification);
                    break;
                }
            }

            if ($certification) {
                $this->model->certification = $certification;
            }
        }
    }

    private function recommendationsConvert(TmdbMovieRecommendations $tmdb)
    {
        if (! $tmdb->results) {
            return;
        }
        foreach ($tmdb->results as $result) {
            $exists = Movie::whereTmdbId($result->id)->first();
            if ($exists) {
                $this->model->recommendations()->attach($exists);
            }
        }
    }

    private function similarConvert(TmdbMovieSimilar $tmdb)
    {
        if (! $tmdb->results) {
            return;
        }
        foreach ($tmdb->results as $result) {
            $exists = Movie::whereTmdbId($result->id)->first();
            if ($exists) {
                $this->model->similars()->attach($exists);
            }
        }
    }
}
