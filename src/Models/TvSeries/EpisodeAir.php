<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

class EpisodeAir
{
    protected ?int $id;

    protected ?string $name;

    protected ?string $overview;

    protected ?float $vote_average;

    protected ?int $vote_count;

    protected ?string $air_date;

    protected ?int $episode_number;

    protected ?string $episode_type;

    protected ?string $production_code;

    protected ?int $runtime;

    protected ?int $season_number;

    protected ?int $show_id;

    protected ?string $still_path;

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

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    public function getVoteCount(): ?int
    {
        return $this->vote_count;
    }

    public function getAirDate(): ?string
    {
        return $this->air_date;
    }

    public function getEpisodeNumber(): ?int
    {
        return $this->episode_number;
    }

    public function getEpisodeType(): ?string
    {
        return $this->episode_type;
    }

    public function getProductionCode(): ?string
    {
        return $this->production_code;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function getSeasonNumber(): ?int
    {
        return $this->season_number;
    }

    public function getShowId(): ?int
    {
        return $this->show_id;
    }

    public function getStillPath(): ?string
    {
        return $this->still_path;
    }
}
