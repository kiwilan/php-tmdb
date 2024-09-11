<?php

namespace Kiwilan\Tmdb;

class TmdbModel
{
    public static function searchMovie(string $query, array $params = [])
    {
        $results = TmdbClient::make()->getSearchApi()->searchMovies('Keep an Eye Out', [
            'year' => 2018,
        ]);
    }
}
