<?php

namespace Kiwilan\Tmdb\Utils;

use Kiwilan\Tmdb\Enums\TmdbLogoSize;

class TmdbLogo extends TmdbImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->imageUrl = $self->fixUrl($url);
        $self->size = TmdbLogoSize::ORIGINAL;

        return $self;
    }

    /**
     * @param  $size  To override the image size, default is `original`
     */
    public function size(TmdbLogoSize $size = TmdbLogoSize::ORIGINAL): self
    {
        $this->size = $size;

        return $this;
    }
}
