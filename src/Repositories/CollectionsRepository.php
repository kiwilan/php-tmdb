<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Models;

/**
 * Collections Repository
 *
 * @docs https://developer.themoviedb.org/reference/collection-details
 */
class CollectionsRepository extends Repository
{
    /**
     * Get collection details by ID.
     *
     * @param  int  $collection_id  The TMDB collection ID
     * @param  ?string  $language  The language to get the collection details (can override the default language)
     *
     * @docs https://developer.themoviedb.org/reference/collection-details
     */
    public function details(int $collection_id, ?string $language = null): ?Models\Collection
    {
        $url = $this->getUrl("/collection/{$collection_id}", [
            'language' => $language ?? $this->language,
        ]);

        $response = $this->execute($url);

        return $this->isSuccess ? new Models\Collection($response) : null;
    }
}
