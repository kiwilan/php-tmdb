<?php

namespace Kiwilan\Tmdb\Models;

class SpokenLanguage
{
    protected ?string $english_name;

    protected ?string $iso_639_1;

    protected ?string $name;

    public function __construct(array $data)
    {
        $this->english_name = $data['english_name'] ?? null;
        $this->iso_639_1 = $data['iso_639_1'] ?? null;
        $this->name = $data['name'] ?? null;
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
