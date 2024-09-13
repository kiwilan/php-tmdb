<?php

namespace Kiwilan\Tmdb\Utils;

use Kiwilan\Tmdb\Enums\ProfileSize;

class TmdbProfile extends TmdbImage
{
    public static function make(?string $url): self
    {
        $self = new self;
        $self->imageUrl = $self->fixUrl($url);
        $self->size = ProfileSize::ORIGINAL;

        return $self;
    }

    /**
     * @param  $size  To override the image size, default is `original`
     */
    public function size(ProfileSize $size = ProfileSize::ORIGINAL): self
    {
        $this->size = $size;

        return $this;
    }
}
