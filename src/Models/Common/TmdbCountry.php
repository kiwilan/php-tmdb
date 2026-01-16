<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits\TmdbIsoCode;

/**
 * Country information.
 */
class TmdbCountry extends TmdbModel
{
    use TmdbIsoCode;

    protected ?string $iso_3166_1 = null;

    protected ?string $english_name = null;

    protected ?string $native_name = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->iso_3166_1 = $this->toString('iso_3166_1');
        $this->english_name = $this->toString('english_name');
        if (! $this->english_name) {
            $this->english_name = $this->toString('name');
        }
        $this->native_name = $this->toString('native_name');
    }

    /**
     * Get Country code ISO 3166-1, like `US`.
     */
    public function getIso3166(): ?string
    {
        return $this->iso_3166_1;
    }

    /**
     * Get Country name, like `United States of America`.
     *
     * Find english name first, and if not available, try with native name.
     */
    public function getName(): ?string
    {
        if ($this->english_name) {
            return $this->english_name;
        }

        return $this->native_name;
    }

    /**
     * Get Country name (english name), like `United States of America`.
     */
    public function getEnglishName(): ?string
    {
        return $this->english_name;
    }

    /**
     * Get Country name (native name), like `United States`.
     */
    public function getNativeName(): ?string
    {
        return $this->native_name;
    }
}
