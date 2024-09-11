<?php

namespace Kiwilan\Tmdb\Traits;

trait HasPoster
{
    protected ?string $poster_path;

    public function getPosterPath(): ?string
    {
        return $this->poster_path;
    }

    public function getPosterUrl(): ?string
    {
        return $this->poster_path;
    }
}
