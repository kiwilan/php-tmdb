<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Models;

/**
 * Credits Repository
 *
 * @docs https://developer.themoviedb.org/reference/credit-details
 */
class CreditsRepository extends Repository
{
    /**
     * Get credits details
     *
     * @param  string  $credit_id  The TMDB credit ID
     */
    public function details(string $credit_id): ?Models\Credit
    {
        $url = $this->getUrl("/credit/{$credit_id}");

        $response = $this->execute($url);

        return $this->isSuccess ? new Models\Credit($response) : null;
    }
}
