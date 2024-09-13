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
     * Get a movie or TV credit details by ID.
     *
     * @param  string  $credit_id  The TMDB credit ID
     */
    public function details(string $credit_id): ?Models\Credit
    {
        $response = $this->get("/credit/{$credit_id}");

        return $this->isSuccess ? new Models\Credit($response) : null;
    }
}
