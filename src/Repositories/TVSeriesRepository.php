<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Models;

/**
 * TV Series Repository
 *
 * @docs https://developer.themoviedb.org/reference/tv-series-details
 */
class TVSeriesRepository extends Repository
{
    /**
     * Get TV series details
     *
     * @param  int  $series_id  The TMDB TV series ID
     * @param  string|null  $append_to_response  To get additional information
     *
     * @docs https://developer.themoviedb.org/reference/tv-series-details
     */
    public function details(int $series_id, ?string $append_to_response = null): ?Models\TvSeries
    {
        $url = $this->getUrl("/tv/{$series_id}");
        $queryParams = [
            'append_to_response' => $append_to_response,
            'language' => $this->language,
        ];

        $response = $this->execute($url, $queryParams);

        return $this->isSuccess ? new Models\TvSeries($response) : null;
    }
}
