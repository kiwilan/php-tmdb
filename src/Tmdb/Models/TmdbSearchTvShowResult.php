<?php

namespace Kiwilan\Tmdb\Models;

class TmdbSearchTvShowResult
{
    public ?bool $adult = null;

    public ?string $backdrop_path = null;

    public ?array $genre_ids = null;

    public ?int $id = null;

    public ?array $origin_country = null;

    public ?string $original_language = null;

    public ?string $original_name = null;

    public ?string $overview = null;

    public ?float $popularity = null;

    public ?string $poster_path = null;

    public ?string $first_air_date = null;

    public ?string $name = null;

    public ?float $vote_average = null;

    public ?int $vote_count = null;

    public function __construct(array $data)
    {
        $this->adult = $data['adult'] ?? null;
        $this->backdrop_path = $data['backdrop_path'] ?? null;
        $this->genre_ids = $data['genre_ids'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->origin_country = $data['origin_country'] ?? null;
        $this->original_language = $data['original_language'] ?? null;
        $this->original_name = $data['original_name'] ?? null;
        $this->overview = $data['overview'] ?? null;
        $this->popularity = $data['popularity'] ?? null;
        $this->poster_path = $data['poster_path'] ?? null;
        $this->first_air_date = $data['first_air_date'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->vote_average = $data['vote_average'] ?? null;
        $this->vote_count = $data['vote_count'] ?? null;
    }
}
