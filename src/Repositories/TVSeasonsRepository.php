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
     * Query the details of a TV season.
     *
     * @param  int  $series_id  The TMDB TV series ID
     * @param  int  $season_number  The season number
     * @param  string[]|null  $append_to_response  To get additional information
     *
     * @docs https://developer.themoviedb.org/reference/tv-season-details
     */
    public function details(int $series_id, int $season_number, ?array $append_to_response = null): ?Models\TvSeries\TmdbSeason
    {
        $response = $this->get("/tv/{$series_id}/season/{$season_number}", [
            'append_to_response' => $this->appendToResponse($append_to_response),
            'language' => $this->language,
        ]);

        return $this->isSuccess ? new Models\TvSeries\TmdbSeason($response, $series_id) : null;
    }
}
