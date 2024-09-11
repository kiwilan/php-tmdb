<?php

namespace Kiwilan\Tmdb\Models;

class TmdbTvShowContentRatings
{
    /** @var TmdbTvShowContentRatingsItem[] */
    public ?array $results = null;

    public ?int $id = null;

    public function __construct(array $data)
    {
        $this->results = array_map(
            fn (array $item) => new TmdbTvShowContentRatingsItem($item),
            $data['results'] ?? []
        );
        $this->id = $data['id'] ?? null;
    }
}

class TmdbTvShowContentRatingsItem
{
    public ?array $descriptors = null;

    public ?string $iso_3166_1 = null;

    public ?string $rating = null;

    public function __construct(array $data)
    {
        $this->descriptors = $data['descriptors'] ?? null;
        $this->iso_3166_1 = $data['iso_3166_1'] ?? null;
        $this->rating = $data['rating'] ?? null;
    }
}
