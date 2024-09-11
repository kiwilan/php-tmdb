<?php

namespace Kiwilan\Tmdb\Models;

class TmdbMovieCollection
{
    public ?int $id = null;

    public ?string $name = null;

    public ?string $overview = null;

    public ?string $poster_path = null;

    public ?string $backdrop_path = null;

    /** @var TmdbSearchMovieResult[] */
    public ?array $parts = null;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->overview = $data['overview'] ?? null;
        $this->poster_path = $data['poster_path'] ?? null;
        $this->backdrop_path = $data['backdrop_path'] ?? null;
        $this->parts = array_map(
            fn (array $partData) => new TmdbSearchMovieResult($partData),
            $data['parts'] ?? []
        );
    }
}
