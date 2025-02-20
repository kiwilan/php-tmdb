<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Models\TmdbModel;

/**
 * A spoken language of a movie or TV series.
 */
class TmdbSpokenLanguage extends TmdbModel
{
    protected ?string $english_name = null;

    protected ?string $iso_639_1 = null;

    protected ?string $name = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->english_name = $this->toString('english_name');
        $this->iso_639_1 = $this->toString('iso_639_1');
        $this->name = $this->toString('name');
    }

    public function getEnglishName(): ?string
    {
        return $this->english_name;
    }

    public function getIso639(): ?string
    {
        return $this->iso_639_1;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
