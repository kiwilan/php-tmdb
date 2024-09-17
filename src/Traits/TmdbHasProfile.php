<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Enums\ProfileSize;
use Kiwilan\Tmdb\Utils\TmdbProfile;

trait TmdbHasProfile
{
    protected ?string $profile_path = null;

    protected function setProfilePath(?array $data, string $key = 'profile_path'): void
    {
        $this->profile_path = $data[$key] ?? null;
    }

    public function getProfilePath(): ?string
    {
        return $this->profile_path;
    }

    public function getProfileUrl(?ProfileSize $size = null): ?string
    {
        $profile = TmdbProfile::make($this->profile_path);
        if ($size) {
            $profile->size($size);
        }

        return $profile->getUrl();
    }

    public function getProfileImage(?ProfileSize $size = null): ?string
    {
        $profile = TmdbProfile::make($this->profile_path);
        if ($size) {
            $profile->size($size);
        }

        return $profile->getImage();
    }

    public function saveProfileImage(string $path, ?ProfileSize $size = null): bool
    {
        $profile = TmdbProfile::make($this->profile_path);
        if ($size) {
            $profile->size($size);
        }

        return $profile->saveImage($path);
    }
}
