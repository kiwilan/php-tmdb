<?php

namespace Kiwilan\Tmdb\Models\Movie;

class BelongsToCollection
{
    public ?int $id;

    public ?string $name;

    public ?string $overview;

    public ?string $poster_path;

    public ?string $backdrop_path;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->overview = $data['overview'] ?? null;
        $this->poster_path = $data['poster_path'] ?? null;
        $this->backdrop_path = $data['backdrop_path'] ?? null;
    }
}
