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
    public function details(int $network_id): ?Models\TvSeries\Network
    {
        $url = $this->getUrl("/network/{$network_id}");

        $response = $this->execute($url);

        return $this->isSuccess ? new Models\TvSeries\Network($response) : null;
    }
}
