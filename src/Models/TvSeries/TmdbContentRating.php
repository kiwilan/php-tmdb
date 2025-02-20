<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

use Kiwilan\Tmdb\Models\TmdbModel;

/**
 * A content rating for a TV series.
 */
class TmdbContentRating extends TmdbModel
{
    /** @var string[]|null */
    protected ?array $descriptors = null;

    protected ?string $iso_3166_1 = null;

    protected ?string $rating = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->descriptors = $this->toArray('descriptors');
        $this->iso_3166_1 = $this->toString('iso_3166_1');
        $this->rating = $this->toString('rating');
    }

    /**
     * Get the descriptors.
     *
     * @return string[]|null
     */
    public function getDescriptors(): ?array
    {
        return $this->descriptors;
    }

    public function getIso3166(): ?string
    {
        return $this->iso_3166_1;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }
}
