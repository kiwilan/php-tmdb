<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Results;

/**
 * Movie Lists Repository
 *
 * @docs https://developer.themoviedb.org/reference/movie-now-playing-list
 */
class MovieListsRepository extends Repository
{
    /**
     * Get a list of movies that are currently in theatres.
     *
     * @param  string  $language  Restrict the results to a specific language
     * @param  int  $page  Choose the page of results to view
     * @param  string  $region  Restrict the results to a specific country
     *
     * @docs https://developer.themoviedb.org/reference/movie-now-playing-list
     */
    public function nowPlaying(string $language, int $page, string $region): ?Results\MovieDateResults
    {
        $response = $this->get('/movie/now_playing', [
            'language' => $language,
            'page' => $page,
            'region' => $region,
        ]);

        return $this->isSuccess ? new Results\MovieDateResults($response) : null;
    }

    /**
     * Get a list of movies ordered by popularity.
     *
     * @param  string  $language  Restrict the results to a specific language
     * @param  int  $page  Choose the page of results to view
     * @param  string  $region  Restrict the results to a specific country
     *
     * @docs https://developer.themoviedb.org/reference/movie-popular-list
     */
    public function popular(string $language, int $page, string $region): ?Results\MovieResults
    {
        $response = $this->get('/movie/popular', [
            'language' => $language,
            'page' => $page,
            'region' => $region,
        ]);

        return $this->isSuccess ? new Results\MovieResults($response) : null;
    }

    /**
     * Get a list of movies ordered by rating.
     *
     * @param  string  $language  Restrict the results to a specific language
     * @param  int  $page  Choose the page of results to view
     * @param  string  $region  Restrict the results to a specific country
     *
     * @docs https://developer.themoviedb.org/reference/movie-top-rated-list
     */
    public function topRated(string $language, int $page, string $region): ?Results\MovieResults
    {
        $response = $this->get('/movie/top_rated', [
            'language' => $language,
            'page' => $page,
            'region' => $region,
        ]);

        return $this->isSuccess ? new Results\MovieResults($response) : null;
    }

    /**
     * Get a list of movies that are being released soon.
     *
     * @param  string  $language  Restrict the results to a specific language
     * @param  int  $page  Choose the page of results to view
     * @param  string  $region  Restrict the results to a specific country
     *
     * @docs https://developer.themoviedb.org/reference/movie-upcoming-list
     */
    public function upcoming(string $language, int $page, string $region): ?Results\MovieDateResults
    {
        $response = $this->get('/movie/upcoming', [
            'language' => $language,
            'page' => $page,
            'region' => $region,
        ]);

        return $this->isSuccess ? new Results\MovieDateResults($response) : null;
    }
}
