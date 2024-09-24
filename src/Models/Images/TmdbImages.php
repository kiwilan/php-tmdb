<?php

namespace Kiwilan\Tmdb\Models\Images;

use Kiwilan\Tmdb\Enums\TmdbImageType;
use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits\TmdbId;

class TmdbImages extends TmdbModel
{
    use TmdbId;

    /** @vaar null|TmdbImage[] */
    protected ?array $backdrops = null;

    /** @vaar null|TmdbImage[] */
    protected ?array $posters = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->setId();

        $this->backdrops = $this->toClassArray('backdrops', TmdbImage::class);
        $this->posters = $this->toClassArray('posters', TmdbImage::class);

        $this->backdrops = $this->setType($this->backdrops, TmdbImageType::BACKDROP);
        $this->posters = $this->setType($this->posters, TmdbImageType::POSTER);
    }

    /**
     * @return null|TmdbImage[]
     */
    public function getBackdrops(): ?array
    {
        return $this->backdrops;
    }

    /**
     * @return null|TmdbImage[]
     */
    public function getPosters(): ?array
    {
        return $this->posters;
    }

    /**
     * @param  TmdbImage[]  $images  The images array
     * @return TmdbImage[]
     */
    private function setType(array $images, TmdbImageType $type): array
    {
        if (! $images) {
            return [];
        }

        foreach ($images as $image) {
            $image->__set('type', $type);
        }

        return $images;
    }
}
