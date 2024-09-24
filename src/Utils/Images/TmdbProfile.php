<?php

namespace Kiwilan\Tmdb\Utils\Images;

use Kiwilan\Tmdb\Enums\TmdbProfileSize;
use Kiwilan\Tmdb\Utils\TmdbUrl;

class TmdbProfile extends TmdbBaseImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->image_path = TmdbUrl::fixUrl($url);
        $self->size = TmdbProfileSize::ORIGINAL;

        return $self;
    }

    /**
     * @param  $size  To override the image size, default is `original`
     */
    public function size(TmdbProfileSize $size = TmdbProfileSize::ORIGINAL): self
    {
        $this->size = $size;

        return $this;
    }
}
