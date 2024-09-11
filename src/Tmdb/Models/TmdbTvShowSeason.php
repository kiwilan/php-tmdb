<?php

namespace Kiwilan\Tmdb\Models;

class TmdbTvShowSeason
{
    public ?string $_id = null;

    public ?string $air_date = null;

    /** @var TmdbTvShowEpisode[]|null */
    public ?array $episodes = null;

    public ?string $name = null;

    public ?string $overview = null;

    public ?int $id = null;

    public ?string $poster_path = null;

    public ?int $season_number = null;

    public ?float $vote_average = null;

    public ?TmdbCredits $credits = null;

    public function __construct(array $data)
    {
        $this->_id = $data['_id'] ?? null;
        $this->air_date = $data['air_date'] ?? null;
        $this->episodes = [];
        if (isset($data['episodes']) && is_array($data['episodes'])) {
            foreach ($data['episodes'] as $seasonData) {
                $this->episodes[] = new TmdbTvShowEpisode($seasonData);
            }
        }
        $this->name = $data['name'] ?? null;
        $this->overview = $data['overview'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->poster_path = $data['poster_path'] ?? null;
        $this->season_number = $data['season_number'] ?? null;
        $this->vote_average = $data['vote_average'] ?? null;

        if (isset($data['credits'])) {
            $this->credits = new TmdbCredits($data['credits']);
        }
    }
}
