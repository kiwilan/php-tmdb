<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Results;

class TVSeriesListRepository extends Repository
{
    /**
     * Get a list of TV shows airing today.
     *
     * @docs https://developer.themoviedb.org/reference/tv-series-airing-today-list
     */
    public function airingToday(string $language = 'en-US', int $page = 1, ?string $timezone = null): ?Results\TvSerieResults
    {
        return $this->fetchData('/tv/airing_today', [
            'language' => $language,
            'page' => $page,
            'timezone' => $timezone,
        ]);
    }

    /**
     * Get a list of TV shows that air in the next 7 days.
     *
     * @docs https://developer.themoviedb.org/reference/tv-series-on-the-air-list
     */
    public function onTheAir(string $language = 'en-US', int $page = 1, ?string $timezone = null): ?Results\TvSerieResults
    {
        return $this->fetchData('/tv/on_the_air', [
            'language' => $language,
            'page' => $page,
            'timezone' => $timezone,
        ]);
    }

    /**
     * Get a list of TV shows ordered by popularity.
     *
     * @docs https://developer.themoviedb.org/reference/tv-series-popular-list
     */
    public function popular(string $language = 'en-US', int $page = 1): ?Results\TvSerieResults
    {
        return $this->fetchData('/tv/popular', [
            'language' => $language,
            'page' => $page,
        ]);
    }

    /**
     * Get a list of TV shows ordered by rating.
     *
     * @docs https://developer.themoviedb.org/reference/tv-series-top-rated-list
     */
    public function topRated(string $language = 'en-US', int $page = 1): ?Results\TvSerieResults
    {
        return $this->fetchData('/tv/top_rated', [
            'language' => $language,
            'page' => $page,
        ]);
    }

    private function fetchData(string $path, array $params = []): ?Results\TvSerieResults
    {
        $url = $this->getUrl($path, $params);

        $response = $this->execute($url);

        return $this->isSuccess ? new Results\TvSerieResults($response) : null;
    }
}
