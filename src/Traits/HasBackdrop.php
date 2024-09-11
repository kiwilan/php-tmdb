<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Enums\BackdropSize;
use Kiwilan\Tmdb\Utils\TmdbBackdrop;

trait HasBackdrop
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

    public function getBackdropUrl(?BackdropSize $size = null): ?string
    {
        $backdrop = TmdbBackdrop::make($this->backdrop_path);
        if ($size) {
            $backdrop->size($size);
        }

        return $backdrop->getUrl();
    }

    public function getBackdropImage(?BackdropSize $size = null): ?string
    {
        $backdrop = TmdbBackdrop::make($this->backdrop_path);
        if ($size) {
            $backdrop->size($size);
        }

        return $backdrop->getImage();
    }

    public function saveBackdropImage(string $path, ?BackdropSize $size = null): bool
    {
        $backdrop = TmdbBackdrop::make($this->backdrop_path);
        if ($size) {
            $backdrop->size($size);
        }

        return $backdrop->saveImage($path);
    }
}
