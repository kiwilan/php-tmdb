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
    public function details(int $collection_id, ?string $language = null): ?Models\TmdbCollection
    {
        $response = $this->get("/collection/{$collection_id}", [
            'language' => $language ?? $this->language,
        ]);

        return $this->isSuccess ? new Models\TmdbCollection($response) : null;
    }

    /**
     * Get collection images by ID.
     *
     * @param  int  $collection_id  The TMDB collection ID
     * @param  ?string  $include_image_language  Specify a comma separated list of ISO-639-1 values to query, for example: `en,null`
     * @param  ?string  $language  The language to get the collection details (can override the default language)
     *
     * @docs https://developer.themoviedb.org/reference/collection-images
     */
    public function images(int $collection_id, ?string $include_image_language = null, ?string $language = null): ?Models\Images\TmdbImages
    {
        $response = $this->get("/collection/{$collection_id}/images", [
            'include_image_language' => $include_image_language,
            'language' => $language,
        ]);

        return $this->isSuccess ? new Models\Images\TmdbImages($response) : null;
    }

    /**
     * Get collection translations by ID.
     *
     * @param  int  $collection_id  The TMDB collection ID
     *
     * @docs https://developer.themoviedb.org/reference/collection-translations
     */
    public function translations(int $collection_id): ?Models\Translations\TmdbTranslations
    {
        $response = $this->get("/collection/{$collection_id}/translations");

        return $this->isSuccess ? new Models\Translations\TmdbTranslations($response) : null;
    }
}
