<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Enums\TmdbBackdropSize;
use Kiwilan\Tmdb\Utils\TmdbBackdrop;

trait TmdbHasBackdrop
{
    protected ?string $backdrop_path = null;

    protected function setBackdropPath(?array $data, string $key = 'backdrop_path'): void
    {
        $this->backdrop_path = $data[$key] ?? null;
    }

    public function getbackdropPath(): ?string
    {
        return $this->backdrop_path;
    }

    public function getBackdropUrl(?TmdbBackdropSize $size = null): ?string
    {
        $backdrop = TmdbBackdrop::make($this->backdrop_path);
        if ($size) {
            $backdrop->size($size);
        }

        return $backdrop->getUrl();
    }

    public function getBackdropImage(?TmdbBackdropSize $size = null): ?string
    {
        $backdrop = TmdbBackdrop::make($this->backdrop_path);
        if ($size) {
            $backdrop->size($size);
        }

        return $backdrop->getImage();
    }

    public function saveBackdropImage(string $path, ?TmdbBackdropSize $size = null): bool
    {
        $backdrop = TmdbBackdrop::make($this->backdrop_path);
        if ($size) {
            $backdrop->size($size);
        }

        return $backdrop->saveImage($path);
    }
}
