<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

use DateTime;
use Kiwilan\Tmdb\Models\Credits;
use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits\HasId;
use Kiwilan\Tmdb\Traits\HasPoster;

/**
 * TV Series Season
 */
class Season extends TmdbModel
{
    use HasId;
    use HasPoster;

    protected ?DateTime $air_date = null;

    /** @var Episode[]|null */
    protected ?array $episodes = null;

    protected ?string $name = null;

    protected ?string $overview = null;

    protected ?int $season_number = null;

    protected ?float $vote_average = null;

    protected ?Credits $credits = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->setPosterPath($data);
        $this->air_date = $this->toDateTime($data, 'air_date');
        $this->episodes = $this->loopOn($data['episodes'] ?? null, Episode::class);
        $this->name = $this->toString($data, 'name');
        $this->overview = $this->toString($data, 'overview');
        $this->season_number = $this->toInt($data, 'season_number');
        $this->vote_average = $this->toFloat($data, 'vote_average');
        $this->credits = $this->toModel($data, 'credits', Credits::class);
    }

    public function getAirDate(): ?DateTime
    {
        return $this->air_date;
    }

    /**
     * Get the episodes.
     *
     * @return Episode[]|null
     */
    public function getEpisodes(): ?array
    {
        return $this->episodes;
    }

    public function getEpisodesCount(): int
    {
        return count($this->episodes);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getSeasonNumber(): ?int
    {
        return $this->season_number;
    }

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    public function getCredits(): ?Credits
    {
        return $this->credits;
    }
}
