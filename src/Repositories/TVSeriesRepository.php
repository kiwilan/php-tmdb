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
     * Get the details of a TV show.
     *
     * @param  int  $series_id  The TMDB TV series ID
     * @param  string[]|null  $append_to_response  To get additional information
     *
     * @docs https://developer.themoviedb.org/reference/tv-series-details
     */
    public function details(int $series_id, ?array $append_to_response = null): ?Models\TvSeries
    {
        $response = $this->get("/tv/{$series_id}", [
            'append_to_response' => $this->appendToResponse($append_to_response),
            'language' => $this->language,
        ]);

        return $this->isSuccess ? new Models\TvSeries($response) : null;
    }
}
