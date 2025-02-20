<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

use DateTime;
use Kiwilan\Tmdb\Models\TmdbCredits;
use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits;

/**
 * TV Series Season
 */
class TmdbSeason extends TmdbModel
{
    use Traits\TmdbId;
    use Traits\TmdbPoster;
    use Traits\TmdbTmdbUrl;
    use Traits\TmdbTranslations;

    protected ?DateTime $air_date = null;

    protected ?int $season_tv_show_id = null;

    /** @var TmdbEpisode[]|null */
    protected ?array $episodes = null;

    protected ?string $name = null;

    protected ?string $overview = null;

    protected ?int $season_number = null;

    protected ?TmdbCredits $credits = null;

    protected ?float $vote_average = null;

    public function __construct(?array $data, ?int $season_tv_show_id = null)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->setId();
        $this->setPosterPath();
        $this->air_date = $this->toDateTime('air_date');
        $this->name = $this->toString('name');
        $this->overview = $this->toString('overview');
        $this->season_number = $this->toInt('season_number');
        $this->vote_average = $this->toFloat('vote_average');
        $this->credits = $this->toModel('credits', TmdbCredits::class);

        $episodes = $data['episodes'] ?? null;
        if ($episodes) {
            foreach ($episodes as $episode) {
                $this->episodes[] = new TmdbEpisode($episode, $season_tv_show_id, $this->season_number);
            }
        }

        $this->season_tv_show_id = $season_tv_show_id;
        $this->translations = $this->parseTranslations();
    }

    public function getAirDate(): ?DateTime
    {
        return $this->air_date;
    }

    /**
     * Get the episodes.
     *
     * @return TmdbEpisode[]|null
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

    public function getSeasonNumber(): int
    {
        return $this->season_number ?? 0;
    }

    public function isSpecialSeason(): bool
    {
        return $this->getSeasonNumber() === 0;
    }

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    /**
     * Get the vote percentage from vote average (rounded to 2 decimal places).
     */
    public function getVotePercentage(): ?float
    {
        return round($this->vote_average * 10, 2);
    }

    public function getCredits(): ?TmdbCredits
    {
        return $this->credits;
    }
}
