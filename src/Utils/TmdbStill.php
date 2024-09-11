<?php

namespace Kiwilan\Tmdb\Utils;

use Kiwilan\Tmdb\Enums\StillSize;

class TmdbStill extends TmdbImage
{
    public static function make(string $url): self
    {
        $self = new self;
        $self->imageUrl = $self->fixUrl($url);
        $self->size = StillSize::ORIGINAL;

        return $self;
    }

    /**
     * @param  $size  To override the image size, default is `original`
     */
    public function size(StillSize $size = StillSize::ORIGINAL): self
    {
        $this->size = $size;

        return $this;
    }
}