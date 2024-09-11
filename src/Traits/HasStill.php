<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Enums\StillSize;
use Kiwilan\Tmdb\Utils\TmdbStill;

trait HasStill
{
    protected ?string $still_path;

    protected function setStillPath(?array $data, string $key = 'still_path'): void
    {
        $this->still_path = $data[$key] ?? null;
    }

    public function getStillPath(): ?string
    {
        return $this->still_path;
    }

    public function getStillUrl(?StillSize $size = null): ?string
    {
        $still = TmdbStill::make($this->still_path);
        if ($size) {
            $still->size($size);
        }

        return $still->getUrl();
    }

    public function getStillImage(?StillSize $size = null): ?string
    {
        $still = TmdbStill::make($this->still_path);
        if ($size) {
            $still->size($size);
        }

        return $still->getImage();
    }

    public function saveStillImage(string $path, ?StillSize $size = null): bool
    {
        $still = TmdbStill::make($this->still_path);
        if ($size) {
            $still->size($size);
        }

        return $still->saveImage($path);
    }
}
