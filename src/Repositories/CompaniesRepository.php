<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Models;

/**
 * Companies Repository
 *
 * @docs https://developer.themoviedb.org/reference/company-details
 */
class CompaniesRepository extends Repository
{
    /**
     * Get the company details by ID.
     *
     * @param  int  $company_id  The TMDB company ID
     */
    public function details(int $company_id): ?Models\Common\Company
    {
        $url = $this->getUrl("/company/{$company_id}");

        $response = $this->execute($url);

        return $this->isSuccess ? new Models\Common\Company($response) : null;
    }
}
