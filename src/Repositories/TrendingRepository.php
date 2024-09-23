<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Enums\TmdbTimeWindow;
use Kiwilan\Tmdb\Results;

class TrendingRepository extends Repository
{
    /**
     * Get the trending movies, TV shows and people.
     *
     * @docs https://developer.themoviedb.org/reference/trending-all
     */
    public function all(TmdbTimeWindow $time_window = TmdbTimeWindow::DAY, string $language = 'en-US'): ?Results\MediaResults
    {
        $response = $this->get("/trending/all/{$time_window->value}", [
            'language' => $language,
        ]);

        return $this->isSuccess ? new Results\MediaResults($response) : null;
    }

    /**
     * Get the trending movies on TMDB.
     *
     * @docs https://developer.themoviedb.org/reference/trending-movies
     */
    public function movies(TmdbTimeWindow $time_window = TmdbTimeWindow::DAY, string $language = 'en-US'): ?Results\MovieResults
    {
        $response = $this->get("/trending/movie/{$time_window->value}", [
            'language' => $language,
        ]);

        return $this->isSuccess ? new Results\MovieResults($response) : null;
    }

    /**
     * Get the trending people on TMDB.
     *
     * @docs https://developer.themoviedb.org/reference/trending-people
     */
    public function people(TmdbTimeWindow $time_window = TmdbTimeWindow::DAY, string $language = 'en-US'): ?Results\PeopleResults
    {
        $response = $this->get("/trending/person/{$time_window->value}", [
            'language' => $language,
        ]);

        return $this->isSuccess ? new Results\PeopleResults($response) : null;
    }

    /**
     * Get the trending TV shows on TMDB.
     *
     * @docs https://developer.themoviedb.org/reference/trending-tv
     */
    public function tv(TmdbTimeWindow $time_window = TmdbTimeWindow::DAY, string $language = 'en-US'): ?Results\TvSerieResults
    {
        $response = $this->get("/trending/tv/{$time_window->value}", [
            'language' => $language,
        ]);

        return $this->isSuccess ? new Results\TvSerieResults($response) : null;
    }
}
