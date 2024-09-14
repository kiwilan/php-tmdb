<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

use DateTime;
use Kiwilan\Tmdb\Models\Credits;
use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits\HasId;
use Kiwilan\Tmdb\Traits\HasPoster;
use Kiwilan\Tmdb\Traits\HasTmdbUrl;
use Kiwilan\Tmdb\Traits\HasVotes;

/**
 * TV Series Season
 */
class Season extends TmdbModel
{
    use HasId;
    use HasPoster;
    use HasTmdbUrl;
    use HasVotes;

    protected ?DateTime $air_date = null;

    protected ?int $season_tv_show_id = null;

    /** @var Episode[]|null */
    protected ?array $episodes = null;

    protected ?string $name = null;

    protected ?string $overview = null;

    protected ?int $season_number = null;

    protected ?Credits $credits = null;

    public function __construct(?array $data, ?int $season_tv_show_id = null)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->setPosterPath($data);
        $this->air_date = $this->toDateTime($data, 'air_date');
        $this->name = $this->toString($data, 'name');
        $this->overview = $this->toString($data, 'overview');
        $this->season_number = $this->toInt($data, 'season_number');
        $this->vote_average = $this->toFloat($data, 'vote_average');
        $this->credits = $this->toModel($data, 'credits', Credits::class);

        $episodes = $data['episodes'] ?? null;
        if ($episodes) {
            foreach ($episodes as $episode) {
                $this->episodes[] = new Episode($episode, $season_tv_show_id, $this->season_number);
            }
        }

        $this->season_tv_show_id = $season_tv_show_id;
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

    public function getSeasonNumber(): int
    {
        return $this->season_number ?? 0;
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

    public function getCredits(): ?Credits
    {
        return $this->credits;
    }
}
