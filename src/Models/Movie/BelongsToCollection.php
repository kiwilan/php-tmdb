<?php

namespace Kiwilan\Tmdb\Models\Movie;

use Kiwilan\Tmdb\Traits\HasPoster;

class BelongsToCollection
{
    use HasPoster;

    public ?int $id;

    public ?string $name;

    public ?string $overview;

    public ?string $backdrop_path;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->overview = $data['overview'] ?? null;
        $this->poster_path = $data['poster_path'] ?? null;
        $this->backdrop_path = $data['backdrop_path'] ?? null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getBackdropPath(): ?string
    {
        return $this->backdrop_path;
    }
}
