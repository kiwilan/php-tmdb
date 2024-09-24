<?php

namespace Kiwilan\Tmdb\Utils\Images;

use Kiwilan\Tmdb\Enums\TmdbStillSize;
use Kiwilan\Tmdb\Utils\TmdbUrl;

class TmdbStill extends TmdbBaseImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->image_path = TmdbUrl::fixUrl($url);
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
