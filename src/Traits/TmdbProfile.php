<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Enums\TmdbProfileSize;
use Kiwilan\Tmdb\Utils\Images\TmdbProfile as TmdbImageProfile;

trait TmdbProfile
{
    protected ?string $profile_path = null;

    protected function setProfilePath(string $key = 'profile_path'): void
    {
        $this->profile_path = $this->raw_data[$key] ?? null;
    }

    public function getProfilePath(): ?string
    {
        return $this->profile_path;
    }

    public function getProfileUrl(?TmdbProfileSize $size = null): ?string
    {
        $profile = TmdbImageProfile::make($this->profile_path);
        if ($size) {
            $profile->size($size);
        }

        return $profile->getUrl();
    }

    public function getProfileImage(?TmdbProfileSize $size = null): ?string
    {
        $profile = TmdbImageProfile::make($this->profile_path);
        if ($size) {
            $profile->size($size);
        }

        return $profile->getImage();
    }

    public function saveProfileImage(string $path, ?TmdbProfileSize $size = null): bool
    {
        $profile = TmdbImageProfile::make($this->profile_path);
        if ($size) {
            $profile->size($size);
        }

        return $profile->saveImage($path);
    }
}
