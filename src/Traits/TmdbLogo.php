<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Enums\TmdbLogoSize;
use Kiwilan\Tmdb\Utils\Images\TmdbLogo as TmdbImageLogo;

trait TmdbLogo
{
    protected ?string $logo_path = null;

    protected function setLogoPath(string $key = 'logo_path'): void
    {
        $this->logo_path = $this->raw_data[$key] ?? null;
    }

    public function getLogoPath(): ?string
    {
        return $this->logo_path;
    }

    public function getLogoUrl(?TmdbLogoSize $size = null): ?string
    {
        $logo = TmdbImageLogo::make($this->logo_path);
        if ($size) {
            $logo->size($size);
        }

        return $logo->getUrl();
    }

    public function getLogoImage(?TmdbLogoSize $size = null): ?string
    {
        $logo = TmdbImageLogo::make($this->logo_path);
        if ($size) {
            $logo->size($size);
        }

        return $logo->getImage();
    }

    public function saveLogoImage(string $path, ?TmdbLogoSize $size = null): bool
    {
        $logo = TmdbImageLogo::make($this->logo_path);
        if ($size) {
            $logo->size($size);
        }

        return $logo->saveImage($path);
    }
}
