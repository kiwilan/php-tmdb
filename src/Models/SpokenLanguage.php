<?php

namespace Kiwilan\Tmdb\Models;

class SpokenLanguage
{
    public ?string $english_name;

    public ?string $iso_639_1;

    public ?string $name;

    public function __construct(array $data)
    {
        $this->english_name = $data['english_name'] ?? null;
        $this->iso_639_1 = $data['iso_639_1'] ?? null;
        $this->name = $data['name'] ?? null;
    }
}
