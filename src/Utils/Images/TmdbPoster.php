<?php

namespace Kiwilan\Tmdb\Utils\Images;

use Kiwilan\Tmdb\Enums\TmdbPosterSize;
use Kiwilan\Tmdb\Utils\TmdbUrl;

class TmdbPoster extends TmdbBaseImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->image_path = TmdbUrl::fixUrl($url);
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
