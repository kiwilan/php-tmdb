<?php

namespace Kiwilan\Tmdb\Models;

class Genre
{
    public ?int $id;

    public ?string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
    }
}
