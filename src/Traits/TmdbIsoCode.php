<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Models\Common\TmdbCountry;
use Kiwilan\Tmdb\Models\Common\TmdbLanguage;

trait TmdbIsoCode
{
    public function getIsoCode(): ?string
    {
        $iso_code = match ($this::class) {
            TmdbCountry::class => 'getIso3166', // @phpstan-ignore-line
            TmdbLanguage::class => 'getIso6391', // @phpstan-ignore-line
            default => 'unknown',
        };

        if (method_exists($this, $iso_code) && is_callable([$this, $iso_code])) {
            return call_user_func([$this, $iso_code]);
        }

        return '';
    }
}
