<?php

namespace Kiwilan\Tmdb\Models;

use DateTime;
use Kiwilan\Tmdb\Models\Common\TmdbVideo;
use Kiwilan\Tmdb\Models\Credits\TmdbCrew;
use Kiwilan\Tmdb\Models\TvSeries\TmdbContentRating;
use Kiwilan\Tmdb\Models\TvSeries\TmdbEpisode;
use Kiwilan\Tmdb\Models\TvSeries\TmdbNetwork;
use Kiwilan\Tmdb\Models\TvSeries\TmdbSeason;
use Kiwilan\Tmdb\Results\TvSerieResults;
use Kiwilan\Tmdb\Traits;

/**
 * TV Series
 */
class TmdbTvSeries extends TmdbExtendedMedia
{
    use Traits\TmdbExternalIds;
    use Traits\TmdbTmdbUrl;
    use Traits\TmdbTranslations;
    use Traits\TmdbVideos;

    /** @var TmdbCrew[] */
    protected ?array $created_by = null;

    protected ?array $episode_run_time = null;

    protected ?DateTime $first_air_date = null;

    protected bool $in_production = false;

    /** @var string[]|null */
    protected ?array $languages = null;

    protected ?DateTime $last_air_date = null;

    protected ?TmdbEpisode $last_episode_to_air = null;

    protected ?string $name = null;

    protected ?string $original_name = null;

    protected ?TmdbEpisode $next_episode_to_air = null;

    /** @var TmdbNetwork[]|null */
    protected ?array $networks = null;

    protected ?int $number_of_episodes = null;

    protected ?int $number_of_seasons = null;

    /** @var TmdbSeason[]|null */
    protected ?array $seasons = null;

    protected ?string $type = null;

    /** @var TmdbContentRating[]|null */
    protected ?array $content_ratings = null;

    protected ?TvSerieResults $recommendations = null;

    protected ?TvSerieResults $similar = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->name = $this->toString('name');
        $this->original_name = $this->toString('original_name');
        $this->episode_run_time = $this->toArray('episode_run_time');
        $this->first_air_date = $this->toDateTime('first_air_date');
        $this->in_production = $this->toBool('in_production');
        $this->languages = $this->toArray('languages');
        $this->last_air_date = $this->toDateTime('last_air_date');
        $this->number_of_episodes = $this->toInt('number_of_episodes');
        $this->number_of_seasons = $this->toInt('number_of_seasons');
        $this->type = $this->toString('type');

        $this->origin_country = $this->toArray('origin_country');
        $this->last_episode_to_air = $this->toModel('last_episode_to_air', TmdbEpisode::class);
        $this->next_episode_to_air = $this->toModel('next_episode_to_air', TmdbEpisode::class);
        $this->recommendations = $this->toModel('recommendations', TvSerieResults::class);
        $this->similar = $this->toModel('similar', TvSerieResults::class);

        $this->created_by = $this->validateData('created_by', fn (array $values) => $this->loopOn($values, TmdbCrew::class));
        $this->networks = $this->validateData('networks', fn (array $values) => $this->loopOn($values, TmdbNetwork::class));
        $this->seasons = $this->validateData('seasons', function (array $values) {
            $seasons = [];
            foreach ($values as $season) {
                $seasons[] = new TmdbSeason($season, $this->getId());
            }

            return $seasons;
        });

        $content_ratings = $data['content_ratings']['results'] ?? null;
        $this->content_ratings = $this->loopOn($content_ratings, TmdbContentRating::class);
        $this->translations = $this->parseTranslations();
        $this->videos = $this->validateData('videos', fn (array $values) => $this->loopOn($values['results'] ?? null, TmdbVideo::class));
        $this->setExternalIds();
    }

    /**
     * Get the creators.
     *
     * @return TmdbCrew[]|null
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

    public function getLastEpisodeToAir(): ?TmdbEpisode
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

    public function getNextEpisodeToAir(): ?TmdbEpisode
    {
        return $this->next_episode_to_air;
    }

    /**
     * Get the networks.
     *
     * @return TmdbNetwork[]|null
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
     * @return TmdbSeason[]|null
     */
    public function getSeasons(): ?array
    {
        return $this->seasons;
    }

    public function getSeasonsCount(): int
    {
        return count($this->seasons);
    }

    /**
     * Get the type, like `Scripted`.
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Get the content ratings.
     *
     * @return TmdbContentRating[]|null
     */
    public function getContentRatings(): ?array
    {
        return $this->content_ratings;
    }

    /**
     * Get the content rating specific to the country.
     *
     * @param  string  $iso_3166_1  The country code, like `US`
     */
    public function getContentRatingSpecific(string $iso_3166_1): ?TmdbContentRating
    {
        $content_ratings = $this->content_ratings;
        if ($content_ratings === null) {
            return null;
        }

        if (count($content_ratings) === 0) {
            return null;
        }

        $ratings = array_filter($content_ratings, fn (TmdbContentRating $item) => $item->getIso3166() === $iso_3166_1);

        if (! $ratings) {
            return null;
        }

        return reset($ratings);
    }

    public function getRecommendations(): ?TvSerieResults
    {
        return $this->recommendations;
    }

    public function getSimilar(): ?TvSerieResults
    {
        return $this->similar;
    }
}
