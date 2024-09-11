<?php

namespace Kiwilan\Tmdb\Models;

use DateTime;
use Kiwilan\Tmdb\Models\Credits\Crew;
use Kiwilan\Tmdb\Models\TvSeries\ContentRating;
use Kiwilan\Tmdb\Models\TvSeries\Episode;
use Kiwilan\Tmdb\Models\TvSeries\Network;
use Kiwilan\Tmdb\Models\TvSeries\Season;

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

    protected ?Search\SearchTvSeries $recommendations = null;

    protected ?Search\SearchTvSeries $similar = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->validateData($data, 'created_by', function (array $values) {
            $this->created_by = $this->loopOn($values, Crew::class);
        });

        $this->episode_run_time = $this->toArray($data, 'episode_run_time');
        $this->first_air_date = $this->toDateTime($data, 'first_air_date');
        $this->in_production = $this->toBool($data, 'in_production');
        $this->languages = $this->toArray($data, 'languages');
        $this->last_air_date = $this->toDateTime($data, 'last_air_date');

        if (isset($data['last_episode_to_air'])) {
            $this->last_episode_to_air = new Episode($data['last_episode_to_air']);
        }

        $this->name = $this->toString($data, 'name');

        if (isset($data['next_episode_to_air'])) {
            $this->next_episode_to_air = new Episode($data['next_episode_to_air']);
        }

        $this->validateData($data, 'networks', function (array $values) {
            $this->networks = $this->loopOn($values, Network::class);
        });

        $this->number_of_episodes = $this->toInt($data, 'number_of_episodes');
        $this->number_of_seasons = $this->toInt($data, 'number_of_seasons');

        $this->validateData($data, 'seasons', function (array $values) {
            $this->seasons = $this->loopOn($values, Season::class);
        });

        $this->type = $this->toString($data, 'type');

        $this->validateData($data, 'content_ratings', function (array $values) {
            $this->content_ratings = $this->loopOn($values, ContentRating::class);
        });

        if (isset($data['recommendations'])) {
            $this->recommendations = new Search\SearchTvSeries($data['recommendations']);
        }

        if (isset($data['similar'])) {
            $this->similar = new Search\SearchTvSeries($data['similar']);
        }
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

    public function isInProduction(): bool
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

    public function getRecommendations(): ?Search\SearchTvSeries
    {
        return $this->recommendations;
    }

    public function getSimilar(): ?Search\SearchTvSeries
    {
        return $this->similar;
    }
}
