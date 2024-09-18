<?php

namespace Kiwilan\Tmdb\Utils;

use Kiwilan\Tmdb\Enums\TmdbPosterSize;

class TmdbPoster extends TmdbImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->imageUrl = $self->fixUrl($url);
        $self->size = TmdbPosterSize::ORIGINAL;

        return $self;
    }

    /**
     * @param  $size  To override the image size, default is `original`
     */
    public function size(TmdbPosterSize $size = TmdbPosterSize::ORIGINAL): self
    {
        $this->size = $size;

        return $this;
    }
}
