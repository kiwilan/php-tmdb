<?php

namespace Kiwilan\Tmdb\Models\Credits;

use DateTime;
use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Models\TvSeries\TmdbEpisode;
use Kiwilan\Tmdb\Models\TvSeries\TmdbSeason;
use Kiwilan\Tmdb\Traits;

class TmdbCreditMedia extends TmdbModel
{
    use Traits\TmdbBackdrop;
    use Traits\TmdbId;
    use Traits\TmdbPoster;
    use Traits\TmdbVotes;

    protected ?string $name = null;

    protected ?string $original_name = null;

    protected ?string $overview = null;

    protected ?string $media_type = null;

    protected bool $adult = false;

    protected ?string $original_language = null;

    /** @var string[]|null */
    protected ?array $genre_ids = null;

    protected ?float $popularity = null;

    protected ?DateTime $first_air_date = null;

    protected ?DateTime $release_date = null;

    protected mixed $video = null;

    /** @var string[]|null */
    protected ?array $origin_country = null;

    protected ?string $character = null;

    /** @var TmdbEpisode[]|null */
    protected ?array $episodes = null;

    /** @var TmdbSeason[]|null */
    protected ?array $seasons = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->setId();
        $this->setBackdropPath();
        $this->setPosterPath();

        $this->name = $this->toString('name');
        $this->original_name = $this->toString('original_name');
        $this->overview = $this->toString('overview');
        $this->media_type = $this->toString('media_type');
        $this->adult = $this->toBool('adult');
        $this->original_language = $this->toString('original_language');
        $this->genre_ids = $this->toArray('genre_ids');
        $this->popularity = $this->toFloat('popularity');
        $this->first_air_date = $this->toDateTime('first_air_date');
        $this->release_date = $this->toDateTime('release_date');
        $this->video = $this->toString('video');
        $this->setVotes();
        $this->origin_country = $this->toArray('origin_country');
        $this->character = $this->toString('character');

        $this->episodes = $this->validateData('episodes', fn (array $values) => $this->loopOn($values, TmdbEpisode::class));
        $this->seasons = $this->validateData('seasons', fn (array $values) => $this->loopOn($values, TmdbSeason::class));
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOriginalName(): ?string
    {
        return $this->original_name;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getMediaType(): ?string
    {
        return $this->media_type;
    }

    public function isAdult(): bool
    {
        return $this->adult;
    }

    public function getOriginalLanguage(): ?string
    {
        return $this->original_language;
    }

    /**
     * @return string[]|null
     */
    public function getGenreIds(): ?array
    {
        return $this->genre_ids;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    public function getFirstAirDate(): ?DateTime
    {
        return $this->first_air_date;
    }

    public function getReleaseDate(): ?DateTime
    {
        return $this->release_date;
    }

    public function getVideo(): mixed
    {
        return $this->video;
    }

    /**
     * @return string[]|null
     */
    public function getOriginCountry(): ?array
    {
        return $this->origin_country;
    }

    public function getCharacter(): ?string
    {
        return $this->character;
    }

    /**
     * @return TmdbEpisode[]|null
     */
    public function getEpisodes(): ?array
    {
        return $this->episodes;
    }

    /**
     * @return TmdbSeason[]|null
     */
    public function getSeasons(): ?array
    {
        return $this->seasons;
    }
}
