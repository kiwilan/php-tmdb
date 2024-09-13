<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Models;

/**
 * Movies Repository
 *
 * @docs https://developer.themoviedb.org/reference/movie-details
 */
class MoviesRepository extends Repository
{
    /**
     * Get the top level details of a movie by ID.
     *
     * @param  int  $movie_id  The TMDB movie ID
     * @param  string[]|null  $append_to_response  To get additional information
     *
     * @docs https://developer.themoviedb.org/reference/movie-details
     */
    public function details(int $movie_id, ?array $append_to_response = null): ?Models\Movie
    {
        $response = $this->get("/movie/{$movie_id}", [
            'append_to_response' => $this->appendToResponse($append_to_response),
            'language' => $this->language,
        ]);

        return $this->isSuccess ? new Models\Movie($response) : null;
    }
}
