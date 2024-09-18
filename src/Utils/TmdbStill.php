<?php

namespace Kiwilan\Tmdb\Utils;

use Kiwilan\Tmdb\Enums\TmdbStillSize;

class TmdbStill extends TmdbImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->imageUrl = $self->fixUrl($url);
        $self->size = TmdbStillSize::ORIGINAL;

        return $self;
    }

    /**
     * @param  $size  To override the image size, default is `original`
     */
    public function size(TmdbStillSize $size = TmdbStillSize::ORIGINAL): self
    {
        $this->size = $size;

        return $this;
    }
}
