<?php

namespace Kiwilan\Tmdb\Models;

class ProductionCompany
{
    public ?int $id;

    public ?string $logo_path;

    public ?string $name;

    public ?string $origin_country;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->logo_path = $data['logo_path'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->origin_country = $data['origin_country'] ?? null;
    }
}
