<?php

namespace Kiwilan\Tmdb\Utils\Images;

use Kiwilan\Tmdb\Enums\TmdbBackdropSize;
use Kiwilan\Tmdb\Utils\TmdbUrl;

class TmdbBackdrop extends TmdbBaseImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->image_path = TmdbUrl::fixUrl($url);
        $self->size = TmdbBackdropSize::ORIGINAL;

        return $self;
    }

    /**
     * @param  $size  To override the image size, default is `original`
     */
    public function size(TmdbBackdropSize $size = TmdbBackdropSize::ORIGINAL): self
    {
        $this->size = $size;

        return $this;
    }
}
