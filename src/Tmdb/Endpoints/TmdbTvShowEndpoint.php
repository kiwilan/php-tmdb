<?php

namespace Kiwilan\Tmdb\Endpoints;

use App\Engines\PosterParser;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Season;
use App\Models\TvShow;
use DateTime;
use Illuminate\Support\Carbon;
use Kiwilan\LaravelNotifier\Facades\Journal;
use Kiwilan\Tmdb\Models\TmdbAlternativeTitle;
use Kiwilan\Tmdb\Models\TmdbAlternativeTitleResult;
use Kiwilan\Tmdb\Models\TmdbSearchTvShow;
use Kiwilan\Tmdb\Models\TmdbTvShow;
use Kiwilan\Tmdb\Models\TmdbTvShowContentRatings;

class TmdbTvShowEndpoint extends TmdbEndpoint
{
    public function __construct(TvShow $model)
    {
        $this->model = $model;

        if (! $this->model->tmdb_id) {
            $url = $this->buildUrl("{$this->baseURL}/search/tv?query={query}&first_air_date_year={year}", [
                'query' => $this->model->title,
                'year' => $this->model->year,
            ]);
            $body = $this->fetchBody($url);
            if (! $body) {
                Journal::warning("No results for TV show {$this->model->title} ({$this->model->year})")->toDatabase();
                $this->model->fetched_has_failed = true;
                $this->model->saveNoSearch();

                return;
            }
            $this->searchConvert(new TmdbSearchTvShow($body));
        }

        if (! $this->model->tmdb_id) {
            return;
        }

        $url = $this->buildUrl("{$this->baseURL}/tv/{tmdb_id}?append_to_response=alternative_titles,content_ratings,credits,recommendations", [
            'tmdb_id' => $this->model->tmdb_id,
        ]);
        $body = $this->fetchBody($url);
        if (! $body) {
            return;
        }

        $details = new TmdbTvShow($body);
        $this->tvShowConvert($details);
        PosterParser::make($this->model);

        $this->addAllMembers(
            $details->credits->cast,
            [
                ...$details->created_by,
                ...$details->credits->crew,
            ],
            $this->model
        );
    }

    private function searchConvert(TmdbSearchTvShow $tmdb)
    {
        $first = array_shift($tmdb->results);

        if (! $first) {
            return;
        }

        $year = $first->first_air_date ? substr($first->first_air_date, 0, 4) : null;
        $this->model->updateNoSearch([
            'tmdb_id' => $first->id,
            'title' => $this->title($first->name),
            'year' => $year,
            'french_title' => null,
            'original_title' => $first->original_name,
            'release_date' => $first->first_air_date,
            'original_language' => $first->original_language,
            'overview' => $first->overview,
            'popularity' => $first->vote_average,
            'popularity_count' => $first->vote_count,
            'backdrop_url' => $this->parseImageUrl($first->backdrop_path),
            'poster_url' => $this->parseImageUrl($first->poster_path),
            'is_adult' => $first->adult,
            'fetched_at' => now(),
        ]);
    }

    private function contentRatingsConvert(TmdbTvShowContentRatings $tmdb)
    {
        $us = array_filter($tmdb->results, fn ($item) => $item->iso_3166_1 === 'US');
        if ($us) {
            $item = array_shift($us);
            $this->model->certification = $item->rating;
        }
    }

    private function alternativeTitlesConvert(TmdbAlternativeTitle $tmdb)
    {
        $items = $tmdb->titles;
        if (! $items) {
            return;
        }

        $item = array_filter($items, fn (TmdbAlternativeTitleResult $item) => $item->iso_3166_1 === 'FR');
        if ($item) {
            $title = array_shift($item);
            $this->model->french_title = $title->title;
        }
    }

    private function tvShowConvert(TmdbTvShow $tmdb)
    {
        $this->model->updateNoSearch([
            'tmdb_id' => $tmdb->id,
            'title' => $this->title($tmdb->name),
            'original_title' => $tmdb->original_name,
            'release_date' => new DateTime($tmdb->first_air_date),
            'original_language' => $tmdb->original_language,
            'overview' => $tmdb->overview,
            'poster_tmdb' => $this->parseImageUrl($tmdb->poster_path),
            'backdrop_tmdb' => $this->parseImageUrl($tmdb->backdrop_path),
            'popularity' => $tmdb->vote_average,
            'popularity_count' => $tmdb->vote_count,
            'is_adult' => $tmdb->adult,
            'homepage' => $tmdb->homepage,
            'tmdb_url' => "https://www.themoviedb.org/tv/{$tmdb->id}",
            'in_production' => $tmdb->in_production,
            'first_air_date' => new Carbon($tmdb->first_air_date),
            'last_air_date' => new Carbon($tmdb->last_air_date),
            'episodes_count_total' => $tmdb->number_of_episodes,
            'seasons_count_total' => $tmdb->number_of_seasons,
            'status' => $tmdb->status,
            'tagline' => $tmdb->tagline,
            'type' => $tmdb->type,
            'fetched_at' => now(),
        ]);

        $isExists = TvShow::query()
            ->where('slug', $this->slug())
            ->where('id', '!=', $this->model->id)
            ->first();

        if ($isExists instanceof TvShow) {
            $seasons = Season::query()
                ->where('tv_show_id', $isExists->id)
                ->get();
            $episodes = Episode::query()
                ->where('tv_show_id', $isExists->id)
                ->get();
            $isExists->delete();

            $this->model->seasons()->saveMany($seasons);
            $this->model->episodes()->saveMany($episodes);

            return;
        }

        $this->genres($tmdb->genres);
        $this->companies($tmdb->production_companies);
        $this->countries($tmdb->production_countries);
        $this->languages($tmdb->spoken_languages);
        $this->networks($tmdb->networks);

        if ($tmdb->seasons) {
            foreach ($tmdb->seasons as $season) {
                Season::query()
                    ->where('tv_show_id', $this->model->id)
                    ->where('number', $season->season_number)
                    ->update([
                        'tmdb_id' => $season->id,
                        'title' => $this->title($season->name),
                        'number' => $season->season_number,
                        'overview' => $season->overview,
                        'poster_tmdb' => $this->parseImageUrl($season->poster_path),
                        'air_date' => $season->air_date,
                        'popularity' => $season->vote_average,
                    ]);
            }
        }

        if ($tmdb->alternative_titles) {
            $this->alternativeTitlesConvert($tmdb->alternative_titles);
        }

        if ($tmdb->content_ratings) {
            $this->contentRatingsConvert($tmdb->content_ratings);
        }

        $this->recommendationsConvert($tmdb);

        $this->model->saveNoSearch();

        // "episode_run_time": [],
        // "languages": [
        //     "en"
        // ],
        // "last_episode_to_air": {
        //     "id": 3846982,
        //     "name": "The Black Queen",
        //     "overview": "Mourning a tragic death, Rhaenyra tries to hold the kingdom together and Daemon prepares for war.",
        //     "vote_average": 8.449,
        //     "vote_count": 49,
        //     "air_date": "2022-10-23",
        //     "episode_number": 10,
        //     "episode_type": "finale",
        //     "production_code": "",
        //     "runtime": 60,
        //     "season_number": 1,
        //     "show_id": 94997,
        //     "still_path": "/8QXW8N0FneCDf8PkTJ0HUXpuVin.jpg"
        // },
        // "next_episode_to_air": null,
        // "origin_country": [
        //     "US"
        // ],
        // "popularity": 318.608,
        // "poster_path": "/1X4h40fcB4WWUmIBK0auT4zRBAV.jpg",
    }

    private function recommendationsConvert(TmdbTvShow $tmdb)
    {
        if (! $tmdb->recommendations) {
            return;
        }
        foreach ($tmdb->recommendations as $result) {
            $exists = TvShow::where('tmdb_id', $result->id)->first();
            if ($exists) {
                $this->model->recommendations()->attach($exists);
            }
        }
    }
}
