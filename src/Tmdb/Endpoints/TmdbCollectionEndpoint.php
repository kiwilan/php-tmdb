<?php

namespace Kiwilan\Tmdb\Endpoints;

use App\Engines\PosterParser;
use App\Models\Collection;
use App\Models\Movie;
use Kiwilan\LaravelNotifier\Facades\Journal;
use Kiwilan\Tmdb\Models\TmdbMovieCollection;

class TmdbCollectionEndpoint extends TmdbEndpoint
{
    public function __construct(Collection $model)
    {
        $this->model = $model;

        $url = $this->buildUrl("{$this->baseURL}/collection/{tmdb_id}", [
            'tmdb_id' => $this->model->tmdb_id,
        ]);
        $body = $this->fetchBody($url);
        if (! $body) {
            Journal::warning("No results for Collection {$this->model->title}, deleting...");
            $this->model->delete();

            return;
        }
        $this->collectionConvert(new TmdbMovieCollection($body));
        PosterParser::make($this->model);
    }

    private function collectionConvert(TmdbMovieCollection $tmdb)
    {
        $this->model->updateQuietly([
            'tmdb_id' => $tmdb->id,
            'title' => $this->title($tmdb->name),
            'overview' => $tmdb->overview,
            'tmdb_url' => "https://www.themoviedb.org/collection/{$tmdb->id}",
            'poster_tmdb' => $this->parseImageUrl($tmdb->poster_path),
            'backdrop_tmdb' => $this->parseImageUrl($tmdb->backdrop_path),
            'fetched_at' => now(),
            'has_new_movie' => false,
        ]);

        foreach ($tmdb->parts as $value) {
            /** @var Movie|null */
            $movie = Movie::where('tmdb_id', $value->id)->first();
            if ($movie) {
                $movie->collection()->associate($this->model);
                $movie->saveNoSearch();
            }
        }

        $this->model->saveNoSearch();
    }
}
