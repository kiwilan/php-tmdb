<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Models\TmdbModel;

/**
 * Country information.
 */
class Country extends TmdbModel
{
    protected ?string $iso_3166_1 = null;

    protected ?string $name = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->iso_3166_1 = $this->toString($data, 'iso_3166_1');
        $this->name = $this->toString($data, 'name');
    }

    public function getIso31661(): ?string
    {
        return $this->iso_3166_1;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
