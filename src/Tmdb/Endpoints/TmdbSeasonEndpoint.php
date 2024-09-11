<?php

namespace Kiwilan\Tmdb\Endpoints;

use App\Engines\PosterParser;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Kiwilan\LaravelNotifier\Facades\Journal;
use Kiwilan\Tmdb\Models\TmdbTvShowEpisode;
use Kiwilan\Tmdb\Models\TmdbTvShowSeason;

class TmdbSeasonEndpoint extends TmdbEndpoint
{
    public function __construct(Season $model)
    {
        $this->model = $model;

        $model->loadMissing(['tvShow']);
        if (! $model->tvShow || ! $model->tvShow->tmdb_id) {
            Journal::error("Season {$model->number} of {$model->tvShow->title} has no tv show or tv show has no tmdb id.");

            return;
        }

        $url = $this->buildUrl("{$this->baseURL}/tv/{tmdb_id}/season/{season_number}?append_to_response=credits", [
            'tmdb_id' => $model->tvShow->tmdb_id,
            'season_number' => $model->number,
        ]);

        $body = $this->fetchBody($url);
        if (! $body) {
            $this->model->fetched_has_failed = true;
            $this->model->saveQuietly();

            return;
        }
        $tmdb = new TmdbTvShowSeason($body);

        $model->updateQuietly([
            'tmdb_id' => $tmdb->id,
            'title' => $tmdb->name,
            'number' => $tmdb->season_number ?? $model->number,
            'episode_total' => $tmdb->episodes ? count($tmdb->episodes) : null,
            'overview' => $tmdb->overview,
            'poster_url' => $this->parseImageUrl($tmdb->poster_path),
            'air_date' => new Carbon($tmdb->air_date),
            'popularity' => $tmdb->vote_average,
            'tmdb_url' => "https://www.themoviedb.org/tv/{$model->tvShow->tmdb_id}/season/{$tmdb->season_number}",
            'fetched_at' => now(),
        ]);

        PosterParser::make($this->model);
        if ($tmdb->credits) {
            $this->addAllMembers($tmdb->credits->cast, $tmdb->credits->crew, $this->model);
        }

        /**
         * Add episodes
         */
        foreach ($tmdb->episodes as $tmdbEpisode) {
            $this->episode($model, $tmdbEpisode);
        }
    }

    private function episode(Season $season, TmdbTvShowEpisode $tmdb): ?Episode
    {
        $season->loadMissing(['tvShow']);
        $name = "{$season->tvShow?->title} S{$season->number} E{$tmdb->episode_number}";
        Journal::info("Scan episode: {$name}...");

        $e = Episode::query()
            ->where('season_id', $season->id)
            ->where('number', $tmdb->episode_number)
            ->first();

        if (! $e) {
            // Journal::warning("Episode {$name} not found.");
            return null;
        }

        /** @var Episode $e */
        $e->updateQuietly([
            'tmdb_id' => $tmdb->id,
            'air_date' => $tmdb->air_date ? new Carbon($tmdb->air_date) : null,
            'title' => $tmdb->name,
            'number' => $tmdb->episode_number,
            'type' => $tmdb->episode_type,
            'overview' => $tmdb->overview,
            'runtime' => $tmdb->runtime,
            'poster_tmdb' => $this->parseImageUrl($tmdb->still_path),
            'popularity' => $tmdb->vote_average,
            'popularity_count' => $tmdb->vote_count,
            'tmdb_url' => "https://www.themoviedb.org/tv/{$season->tvShow->tmdb_id}/season/{$season->number}/episode/{$tmdb->episode_number}",
            'fetched_at' => now(),
        ]);

        /** @var Carbon|null $date */
        $date = $e->air_date;
        if (! $e->release_date) {
            $e->release_date = $date;
        }
        if (! $e->year) {
            $e->year = $date->year;
        }
        if (str_contains($e->reference, 'YEAR')) {
            $e->reference = str_replace('YEAR', strval($date->year), $e->reference);
        }
        $e->saveQuietly();

        PosterParser::make($e);
        $this->addAllMembers($tmdb->guest_stars, $tmdb->crew, $e);

        Log::debug("Scan {$name} done.");

        return $e;
    }
}
