<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Models;

/**
 * TV Season Repository
 *
 * @docs https://developer.themoviedb.org/reference/tv-season-details
 */
class TVSeasonsRepository extends Repository
{
    /**
     * Get season details
     *
     * @param  int  $series_id  The TMDB TV series ID
     * @param  int  $season_number  The season number
     * @param  string|null  $append_to_response  To get additional information
     *
     * @docs https://developer.themoviedb.org/reference/tv-season-details
     */
    public function details(int $series_id, int $season_number, ?string $append_to_response = null): ?Models\TvSeries\Season
    {
        $url = $this->getUrl("/tv/{$series_id}/season/{$season_number}");
        $queryParams = [
            'append_to_response' => $append_to_response,
            'language' => $this->language,
        ];

        $response = $this->execute($url, $queryParams);

        return $this->isSuccess ? new Models\TvSeries\Season($response) : null;
    }
}
