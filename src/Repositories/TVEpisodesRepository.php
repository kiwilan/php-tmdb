<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Models;

/**
 * TV Episode Repository
 *
 * @docs https://developer.themoviedb.org/reference/tv-episode-details
 */
class TVEpisodesRepository extends Repository
{
    /**
     * Query the details of a TV episode.
     *
     * @param  int  $series_id  The TMDB TV series ID
     * @param  int  $season_number  The season number
     * @param  int  $episode_number  The episode number
     * @param  string[]|null  $append_to_response  To get additional information
     *
     * @docs https://developer.themoviedb.org/reference/tv-episode-details
     */
    public function details(int $series_id, int $season_number, int $episode_number, ?array $append_to_response = null): ?Models\TvSeries\Episode
    {
        $response = $this->get("/tv/{$series_id}/season/{$season_number}/episode/{$episode_number}", [
            'append_to_response' => $this->appendToResponse($append_to_response),
            'language' => $this->language,
        ]);

        return $this->isSuccess ? new Models\TvSeries\Episode($response, $series_id, $season_number) : null;
    }
}
