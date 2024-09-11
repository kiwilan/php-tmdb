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
     * Get movie details
     *
     * @param  int  $movie_id  The TMDB movie ID
     * @param  string|null  $append_to_response  To get additional information
     *
     * @docs https://developer.themoviedb.org/reference/movie-details
     */
    public function details(int $movie_id, ?string $append_to_response = null): ?Models\Movie
    {
        $url = $this->getUrl("/movie/{$movie_id}");
        $queryParams = [
            'append_to_response' => $append_to_response,
            'language' => $this->language,
        ];

        $response = $this->execute($url, $queryParams);

        return $this->isSuccess ? new Models\Movie($response) : null;
    }
}
