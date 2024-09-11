<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Enums\PosterSize;
use Kiwilan\Tmdb\Utils\TmdbPoster;

trait HasPoster
{
    protected ?string $poster_path;

    protected function setPosterPath(?array $data, string $key = 'poster_path'): void
    {
        $this->poster_path = $data[$key] ?? null;
    }

    public function getPosterPath(): ?string
    {
        return $this->poster_path;
    }

    public function getPosterUrl(?PosterSize $size = null): ?string
    {
        return TmdbPoster::make($this->poster_path)->getUrl($size);
    }

    public function getPosterImage(?PosterSize $size = null): ?string
    {
        return TmdbPoster::make($this->poster_path)->getImage($size);
    }

    public function savePosterImage(string $path, ?PosterSize $size = null): bool
    {
        return TmdbPoster::make($this->poster_path)->saveImage($path, $size);
    }
}
