<?php

namespace Kiwilan\Tmdb\Models;

class TmdbEpisodeAir
{
    public ?int $id;

    public ?string $name;

    public ?string $overview;

    public ?float $vote_average;

    public ?int $vote_count;

    public ?string $air_date;

    public ?int $episode_number;

    public ?string $episode_type;

    public ?string $production_code;

    public ?int $runtime;

    public ?int $season_number;

    public ?int $show_id;

    public ?string $still_path;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->overview = $data['overview'] ?? null;
        $this->vote_average = $data['vote_average'] ?? null;
        $this->vote_count = $data['vote_count'] ?? null;
        $this->air_date = $data['air_date'] ?? null;
        $this->episode_number = $data['episode_number'] ?? null;
        $this->episode_type = $data['episode_type'] ?? null;
        $this->production_code = $data['production_code'] ?? null;
        $this->runtime = $data['runtime'] ?? null;
        $this->season_number = $data['season_number'] ?? null;
        $this->show_id = $data['show_id'] ?? null;
        $this->still_path = $data['still_path'] ?? null;
    }
}
