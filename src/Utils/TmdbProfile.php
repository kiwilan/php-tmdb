<?php

namespace Kiwilan\Tmdb\Utils;

use Kiwilan\Tmdb\Enums\TmdbProfileSize;

class TmdbProfile extends TmdbImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->imageUrl = $self->fixUrl($url);
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
