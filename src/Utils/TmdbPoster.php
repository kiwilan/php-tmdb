<?php

namespace Kiwilan\Tmdb\Utils;

use Kiwilan\Tmdb\Enums\PosterSize;

class TmdbPoster extends TmdbImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->imageUrl = $self->fixUrl($url);
        $self->size = PosterSize::ORIGINAL;

        return $self;
    }

    /**
     * @param  $size  To override the image size, default is `original`
     */
    public function size(PosterSize $size = PosterSize::ORIGINAL): self
    {
        $this->size = $size;

        return $this;
    }
}
