<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Models;

/**
 * Networks Repository
 *
 * @docs https://developer.themoviedb.org/reference/network-details
 */
class NetworksRepository extends Repository
{
    /**
     * Get details of a network by ID.
     *
     * @param  int  $network_id  The TMDB network ID
     *
     * @docs https://developer.themoviedb.org/reference/network-details
     */
    public function details(int $network_id): ?Models\TvSeries\TmdbNetwork
    {
        $response = $this->get("/network/{$network_id}");

        return $this->isSuccess ? new Models\TvSeries\TmdbNetwork($response) : null;
    }
}
