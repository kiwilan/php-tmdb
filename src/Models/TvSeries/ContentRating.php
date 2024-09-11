<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

use Kiwilan\Tmdb\Models\TmdbModel;

class ContentRating extends TmdbModel
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

        $this->descriptors = $this->toArray($data, 'descriptors');
        $this->iso_3166_1 = $this->toString($data, 'iso_3166_1');
        $this->rating = $this->toString($data, 'rating');
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

    public function getIso31661(): ?string
    {
        return $this->iso_3166_1;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }
}
