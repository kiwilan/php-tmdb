<?php

namespace Kiwilan\Tmdb\Utils;

use Kiwilan\Tmdb\Enums\LogoSize;

class TmdbLogo extends TmdbImage
{
    public static function make(string $url): self
    {
        $self = new self;
        $self->imageUrl = $self->fixUrl($url);
        $self->size = LogoSize::ORIGINAL;

        return $self;
    }

    /**
     * @param  $size  To override the image size, default is `original`
     */
    public function size(LogoSize $size = LogoSize::ORIGINAL): self
    {
        $this->size = $size;

        return $this;
    }
}
