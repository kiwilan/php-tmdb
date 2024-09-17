<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Enums\PosterSize;
use Kiwilan\Tmdb\Utils\TmdbPoster;

trait TmdbHasPoster
{
    protected ?string $poster_path = null;

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
        $poster = TmdbPoster::make($this->poster_path);
        if ($size) {
            $poster->size($size);
        }

        return $poster->getUrl();
    }

    public function getPosterImage(?PosterSize $size = null): ?string
    {
        $poster = TmdbPoster::make($this->poster_path);
        if ($size) {
            $poster->size($size);
        }

        return $poster->getImage();
    }

    public function savePosterImage(string $path, ?PosterSize $size = null): bool
    {
        $poster = TmdbPoster::make($this->poster_path);
        if ($size) {
            $poster->size($size);
        }

        return $poster->saveImage($path);
    }
}
