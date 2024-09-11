<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Traits\HasLogo;

class Company
{
    use HasLogo;

    protected ?int $id;

    protected ?string $logo_path;

    protected ?string $name;

    protected ?string $origin_country;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->logo_path = $data['logo_path'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->origin_country = $data['origin_country'] ?? null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogoPath(): ?string
    {
        return $this->logo_path;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOriginCountry(): ?string
    {
        return $this->origin_country;
    }
}
