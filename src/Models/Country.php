<?php

namespace Kiwilan\Tmdb\Models;

class Country
{
    protected ?string $iso_3166_1;

    protected ?string $name;

    public function __construct(array $data)
    {
        $this->iso_3166_1 = $data['iso_3166_1'] ?? null;
        $this->name = $data['name'] ?? null;
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
