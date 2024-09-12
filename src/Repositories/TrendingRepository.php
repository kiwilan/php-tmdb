<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Enums\TimeWindow;
use Kiwilan\Tmdb\Results;

class TrendingRepository extends Repository
{
    /**
     * Get the trending movies, TV shows and people.
     *
     * @param  string  $language  The season number
     *
     * @docs https://developer.themoviedb.org/reference/trending-all
     */
    public function all(TimeWindow $time_window = TimeWindow::DAY, string $language = 'en-US'): ?Results\MediaResults
    {
        $url = $this->getUrl("/trending/all/{$time_window->value}", [
            'language' => $language,
        ]);

        $response = $this->execute($url);

        return $this->isSuccess ? new Results\MediaResults($response) : null;
    }

    /**
     * Get the trending movies on TMDB.
     *
     * @param  string  $language  The season number
     *
     * @docs https://developer.themoviedb.org/reference/trending-movies
     */
    public function movies(TimeWindow $time_window = TimeWindow::DAY, string $language = 'en-US'): ?Results\MovieResults
    {
        $url = $this->getUrl("/trending/movie/{$time_window->value}", [
            'language' => $language,
        ]);

        $response = $this->execute($url);

        return $this->isSuccess ? new Results\MovieResults($response) : null;
    }

    /**
     * Get the trending people on TMDB.
     *
     * @param  string  $language  The season number
     *
     * @docs https://developer.themoviedb.org/reference/trending-people
     */
    public function people(TimeWindow $time_window = TimeWindow::DAY, string $language = 'en-US'): ?Results\PeopleResults
    {
        $url = $this->getUrl("/trending/person/{$time_window->value}", [
            'language' => $language,
        ]);

        $response = $this->execute($url);

        return $this->isSuccess ? new Results\PeopleResults($response) : null;
    }

    /**
     * Get the trending TV shows on TMDB.
     *
     * @param  string  $language  The season number
     *
     * @docs https://developer.themoviedb.org/reference/trending-tv
     */
    public function tv(TimeWindow $time_window = TimeWindow::DAY, string $language = 'en-US'): ?Results\TvSerieResults
    {
        $url = $this->getUrl("/trending/tv/{$time_window->value}", [
            'language' => $language,
        ]);

        $response = $this->execute($url);

        return $this->isSuccess ? new Results\TvSerieResults($response) : null;
    }
}
