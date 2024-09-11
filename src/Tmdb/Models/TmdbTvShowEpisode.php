<?php

namespace Kiwilan\Tmdb\Models;

class TmdbTvShowEpisode
{
    public ?string $air_date;

    /** @var TmdbCrew[]|null */
    public ?array $crew;

    public ?int $episode_number;

    public ?string $episode_type;

    /** @var TmdbCrew[]|null */
    public ?array $guest_stars;

    public ?string $name;

    public ?string $overview;

    public ?int $id;

    public ?string $production_code;

    public ?int $runtime;

    public ?int $season_number;

    public ?string $still_path;

    public ?float $vote_average;

    public ?int $vote_count;

    public function __construct(array $data)
    {
        $this->air_date = $data['air_date'] ?? null;
        $this->crew = [];
        if (isset($data['crew']) && is_array($data['crew'])) {
            foreach ($data['crew'] as $crewData) {
                $this->crew[] = new TmdbCrew($crewData);
            }
        }
        $this->episode_number = $data['episode_number'] ?? null;
        $this->episode_type = $data['episode_type'] ?? null;
        $this->guest_stars = [];
        if (isset($data['guest_stars']) && is_array($data['guest_stars'])) {
            foreach ($data['guest_stars'] as $guestStarData) {
                $this->guest_stars[] = new TmdbCrew($guestStarData);
            }
        }
        $this->name = $data['name'] ?? null;
        $this->overview = $data['overview'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->production_code = $data['production_code'] ?? null;
        $this->runtime = $data['runtime'] ?? null;
        $this->season_number = $data['season_number'] ?? null;
        $this->still_path = $data['still_path'] ?? null;
        $this->vote_average = $data['vote_average'] ?? null;
        $this->vote_count = $data['vote_count'] ?? null;
    }
}
