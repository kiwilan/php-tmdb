<?php

namespace Kiwilan\Tmdb\Models;

use DateTime;
use Kiwilan\Tmdb\Models\Credits\Crew;
use Kiwilan\Tmdb\Models\TvSeries\ContentRating;
use Kiwilan\Tmdb\Models\TvSeries\Episode;
use Kiwilan\Tmdb\Models\TvSeries\Network;
use Kiwilan\Tmdb\Models\TvSeries\Season;
use Kiwilan\Tmdb\Search\SearchTvSeries;

class TvSeries extends Media
{
    /** @var Crew[] */
    protected ?array $created_by = null;

    protected ?array $episode_run_time = null;

    protected ?DateTime $first_air_date = null;

    protected bool $in_production = false;

    /** @var string[]|null */
    protected ?array $languages = null;

    protected ?DateTime $last_air_date = null;

    protected ?Episode $last_episode_to_air = null;

    protected ?string $name = null;

    protected ?string $original_name = null;

    protected ?Episode $next_episode_to_air = null;

    /** @var Network[]|null */
    protected ?array $networks = null;

    protected ?int $number_of_episodes = null;

    protected ?int $number_of_seasons = null;

    /** @var Season[]|null */
    protected ?array $seasons = null;

    protected ?string $type = null;

    /** @var ContentRating[]|null */
    protected ?array $content_ratings = null;

    protected ?SearchTvSeries $recommendations = null;

    protected ?SearchTvSeries $similar = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->episode_run_time = $this->toArray($data, 'episode_run_time');
        $this->first_air_date = $this->toDateTime($data, 'first_air_date');
        $this->in_production = $this->toBool($data, 'in_production');
        $this->languages = $this->toArray($data, 'languages');
        $this->last_air_date = $this->toDateTime($data, 'last_air_date');
        $this->name = $this->toString($data, 'name');
        $this->original_name = $this->toString($data, 'original_name');
        $this->number_of_episodes = $this->toInt($data, 'number_of_episodes');
        $this->number_of_seasons = $this->toInt($data, 'number_of_seasons');
        $this->type = $this->toString($data, 'type');

        $this->last_episode_to_air = $this->toModel($data, 'last_episode_to_air', Episode::class);
        $this->next_episode_to_air = $this->toModel($data, 'next_episode_to_air', Episode::class);
        $this->recommendations = $this->toModel($data, 'recommendations', SearchTvSeries::class);
        $this->similar = $this->toModel($data, 'similar', SearchTvSeries::class);

        $this->created_by = $this->validateData($data, 'created_by', fn (array $values) => $this->loopOn($values, Crew::class));
        $this->networks = $this->validateData($data, 'networks', fn (array $values) => $this->loopOn($values, Network::class));
        $this->seasons = $this->validateData($data, 'seasons', fn (array $values) => $this->loopOn($values, Season::class));
        $this->content_ratings = $this->validateData($data, 'content_ratings', fn (array $values) => $this->loopOn($values, ContentRating::class));
    }

    /**
     * Get the creators.
     *
     * @return Crew[]|null
     */
    public function getCreatedBy(): ?array
    {
        return $this->created_by;
    }

    /**
     * Get the episode run time.
     */
    public function getEpisodeRunTime(): ?array
    {
        return $this->episode_run_time;
    }

    public function getFirstAirDate(): ?DateTime
    {
        return $this->first_air_date;
    }

    public function inProduction(): bool
    {
        return $this->in_production;
    }

    /**
     * Get the languages.
     *
     * @return string[]|null
     */
    public function getLanguages(): ?array
    {
        return $this->languages;
    }

    public function getLastAirDate(): ?DateTime
    {
        return $this->last_air_date;
    }

    public function getLastEpisodeToAir(): ?Episode
    {
        return $this->last_episode_to_air;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOriginalName(): ?string
    {
        return $this->original_name;
    }

    public function getNextEpisodeToAir(): ?Episode
    {
        return $this->next_episode_to_air;
    }

    /**
     * Get the networks.
     *
     * @return Network[]|null
     */
    public function getNetworks(): ?array
    {
        return $this->networks;
    }

    public function getNumberOfEpisodes(): int
    {
        return $this->number_of_episodes;
    }

    public function getNumberOfSeasons(): int
    {
        return $this->number_of_seasons;
    }

    /**
     * Get the seasons.
     *
     * @return Season[]|null
     */
    public function getSeasons(): ?array
    {
        return $this->seasons;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Get the content ratings.
     *
     * @return ContentRating[]|null
     */
    public function getContentRatings(): ?array
    {
        return $this->content_ratings;
    }

    public function getRecommendations(): ?SearchTvSeries
    {
        return $this->recommendations;
    }

    public function getSimilar(): ?SearchTvSeries
    {
        return $this->similar;
    }
}
