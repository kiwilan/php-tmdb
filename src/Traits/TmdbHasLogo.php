<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Enums\LogoSize;
use Kiwilan\Tmdb\Utils\TmdbLogo;

trait TmdbHasLogo
{
    protected ?string $logo_path = null;

    protected function setLogoPath(?array $data, string $key = 'logo_path'): void
    {
        $this->logo_path = $data[$key] ?? null;
    }

    public function getLogoPath(): ?string
    {
        return $this->logo_path;
    }

    public function getLogoUrl(?LogoSize $size = null): ?string
    {
        $logo = TmdbLogo::make($this->logo_path);
        if ($size) {
            $logo->size($size);
        }

        return $logo->getUrl();
    }

    public function getLogoImage(?LogoSize $size = null): ?string
    {
        $logo = TmdbLogo::make($this->logo_path);
        if ($size) {
            $logo->size($size);
        }

        return $logo->getImage();
    }

    public function saveLogoImage(string $path, ?LogoSize $size = null): bool
    {
        $logo = TmdbLogo::make($this->logo_path);
        if ($size) {
            $logo->size($size);
        }

        return $logo->saveImage($path);
    }
}
