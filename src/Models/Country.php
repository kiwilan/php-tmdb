<?php

namespace Kiwilan\Tmdb\Models;

class Country
{
    public ?string $iso_3166_1;

    public ?string $name;

    public function __construct(array $data)
    {
        $this->iso_3166_1 = $data['iso_3166_1'] ?? null;
        $this->name = $data['name'] ?? null;
    }
}
