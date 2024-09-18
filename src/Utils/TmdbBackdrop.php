<?php

namespace Kiwilan\Tmdb\Utils;

use Kiwilan\Tmdb\Enums\TmdbBackdropSize;

class TmdbBackdrop extends TmdbImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->imageUrl = $self->fixUrl($url);
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
