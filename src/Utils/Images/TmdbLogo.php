<?php

namespace Kiwilan\Tmdb\Utils\Images;

use Kiwilan\Tmdb\Enums\TmdbLogoSize;
use Kiwilan\Tmdb\Utils\TmdbUrl;

class TmdbLogo extends TmdbBaseImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->image_path = TmdbUrl::fixUrl($url);
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
