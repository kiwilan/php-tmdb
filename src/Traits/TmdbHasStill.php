<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Enums\TmdbStillSize;
use Kiwilan\Tmdb\Utils\TmdbStill;

trait TmdbHasStill
{
    protected ?string $still_path = null;

    protected function setStillPath(?array $data, string $key = 'still_path'): void
    {
        $this->still_path = $data[$key] ?? null;
    }

    public function getStillPath(): ?string
    {
        return $this->still_path;
    }

    public function getStillUrl(?TmdbStillSize $size = null): ?string
    {
        $still = TmdbStill::make($this->still_path);
        if ($size) {
            $still->size($size);
        }

        return $still->getUrl();
    }

    public function getStillImage(?TmdbStillSize $size = null): ?string
    {
        $still = TmdbStill::make($this->still_path);
        if ($size) {
            $still->size($size);
        }

        return $still->getImage();
    }

    public function saveStillImage(string $path, ?TmdbStillSize $size = null): bool
    {
        $still = TmdbStill::make($this->still_path);
        if ($size) {
            $still->size($size);
        }

        return $still->saveImage($path);
    }
}
