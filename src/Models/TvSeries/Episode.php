<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

use DateTime;
use Kiwilan\Tmdb\Models\Credits;
use Kiwilan\Tmdb\Models\Credits\Cast;
use Kiwilan\Tmdb\Models\Credits\Crew;
use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits\HasId;
use Kiwilan\Tmdb\Traits\HasStill;

class Episode extends TmdbModel
{
    use HasId;
    use HasStill;

    protected ?DateTime $air_date = null;

    /** @var Crew[]|null */
    protected ?array $crew = null;

    protected ?int $episode_number = null;

    /** @var Cast[]|null */
    protected ?array $cast = null;

    protected ?string $name = null;

    protected ?string $overview = null;

    protected ?string $production_code = null;

    protected ?int $runtime = null;

    protected ?int $season_number = null;

    protected ?float $vote_average = null;

    protected ?int $vote_count = null;

    protected ?Credits $credits = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->setStillPath($data);

        $this->air_date = $this->toDateTime($data, 'air_date');
        $this->episode_number = $this->toInt($data, 'episode_number');
        $this->name = $this->toString($data, 'name');
        $this->overview = $this->toString($data, 'overview');
        $this->production_code = $this->toString($data, 'production_code');
        $this->runtime = $this->toInt($data, 'runtime');
        $this->season_number = $this->toInt($data, 'season_number');
        $this->vote_average = $this->toFloat($data, 'vote_average');
        $this->vote_count = $this->toInt($data, 'vote_count');

        $this->credits = new Credits([
            'cast' => $data['guest_stars'] ?? [],
            'crew' => $data['crew'] ?? [],
        ]);
    }

    public function getAirDate(): ?DateTime
    {
        return $this->air_date;
    }

    public function getEpisodeNumber(): ?int
    {
        return $this->episode_number;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
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

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    public function getVoteCount(): ?int
    {
        return $this->vote_count;
    }

    public function getCredits(): ?Credits
    {
        return $this->credits;
    }
}
