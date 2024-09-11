<?php

namespace Kiwilan\Tmdb\Endpoints;

use App\Models\Movie;
use App\Models\TvShow;
use Kiwilan\LaravelNotifier\Facades\Journal;
use Kiwilan\Tmdb\Models\TmdbMovieRecommendations;
use Kiwilan\Tmdb\Models\TmdbTvShowRecommendations;

class TmdbRecommendationEndpoint extends TmdbEndpoint
{
    public function __construct(Movie|TvShow $model)
    {
        $this->model = $model;

        $url = "{$this->baseURL}/movie/{tmdb_id}/recommendations";
        if ($this->model instanceof TvShow) {
            $url = "{$this->baseURL}/tv/{tmdb_id}/recommendations";
        }
        $url = $this->buildUrl($url, [
            'tmdb_id' => $this->model->tmdb_id,
        ]);

        $body = $this->fetchBody($url);
        if (! $body) {
            Journal::warning("No results for model {$model->tmdb_id}");

            return;
        }

        $tmdb = null;
        $class = null;
        if ($this->model instanceof Movie) {
            $tmdb = new TmdbMovieRecommendations($body);
            $class = Movie::class;
        } elseif ($this->model instanceof TvShow) {
            $tmdb = new TmdbTvShowRecommendations($body);
            $class = TvShow::class;
        }

        $this->recommendations($tmdb->results, $class);
        $this->model->saveNoSearch();
    }

    private function recommendations(mixed $results, string $class)
    {
        if (! $results) {
            return;
        }

        foreach ($results as $result) {
            $exists = $class::where('tmdb_id', $result->id)->first();
            if ($exists) {
                $this->model->recommendations()->detach($exists);
                $this->model->recommendations()->attach($exists);
            }
        }
    }
}
