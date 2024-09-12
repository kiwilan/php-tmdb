<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Search;

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
    public function nowPlaying(string $language, int $page, string $region): ?Search\SearchMoviesDates
    {
        $url = $this->getUrl('/movie/now_playing', [
            'language' => $language,
            'page' => $page,
            'region' => $region,
        ]);

        $response = $this->execute($url);

        return $this->isSuccess ? new Search\SearchMoviesDates($response) : null;
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
    public function popular(string $language, int $page, string $region): ?Search\SearchMovies
    {
        $url = $this->getUrl('/movie/popular', [
            'language' => $language,
            'page' => $page,
            'region' => $region,
        ]);

        $response = $this->execute($url);

        return $this->isSuccess ? new Search\SearchMovies($response) : null;
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
    public function topRated(string $language, int $page, string $region): ?Search\SearchMovies
    {
        $url = $this->getUrl('/movie/top_rated', [
            'language' => $language,
            'page' => $page,
            'region' => $region,
        ]);

        $response = $this->execute($url);

        return $this->isSuccess ? new Search\SearchMovies($response) : null;
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
    public function upcoming(string $language, int $page, string $region): ?Search\SearchMoviesDates
    {
        $url = $this->getUrl('/movie/upcoming', [
            'language' => $language,
            'page' => $page,
            'region' => $region,
        ]);

        $response = $this->execute($url);

        return $this->isSuccess ? new Search\SearchMoviesDates($response) : null;
    }
}
