<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Models\TmdbModel;

class SpokenLanguage extends TmdbModel
{
    protected ?string $english_name = null;

    protected ?string $iso_639_1 = null;

    protected ?string $name = null;

    public function __construct(array $data)
    {
        $this->english_name = $this->toString($data, 'english_name');
        $this->iso_639_1 = $this->toString($data, 'iso_639_1');
        $this->name = $this->toString($data, 'name');
    }

    public function getEnglishName(): ?string
    {
        return $this->english_name;
    }

    public function getIso6391(): ?string
    {
        return $this->iso_639_1;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
