<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Enums\PosterSize;
use Kiwilan\Tmdb\Utils\TmdbPoster;

trait HasBackdrop
{
    protected ?string $backdrop_path;

    protected function setBackdropPath(?array $data, string $key = 'backdrop_path'): void
    {
        $this->backdrop_path = $data[$key] ?? null;
    }

    public function getbackdropPath(): ?string
    {
        return $this->backdrop_path;
    }

    public function getBackdropUrl(?PosterSize $size = null): ?string
    {
        return TmdbPoster::make($this->backdrop_path)->getUrl($size);
    }

    public function getBackdropImage(?PosterSize $size = null): ?string
    {
        return TmdbPoster::make($this->backdrop_path)->getImage($size);
    }

    public function saveBackdropImage(string $path, ?PosterSize $size = null): bool
    {
        return TmdbPoster::make($this->backdrop_path)->saveImage($path, $size);
    }
}
