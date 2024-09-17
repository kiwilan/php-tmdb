<?php

namespace Kiwilan\Tmdb\Models\Credits;

use DateTime;
use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Models\TvSeries\Episode;
use Kiwilan\Tmdb\Models\TvSeries\Season;
use Kiwilan\Tmdb\Traits;

class CreditMedia extends TmdbModel
{
    use Traits\TmdbHasBackdrop;
    use Traits\TmdbHasId;
    use Traits\TmdbHasPoster;
    use Traits\TmdbHasVotes;

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

    /** @var Episode[]|null */
    protected ?array $episodes = null;

    /** @var Season[]|null */
    protected ?array $seasons = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->setBackdropPath($data);
        $this->setPosterPath($data);

        $this->name = $this->toString($data, 'name');
        $this->original_name = $this->toString($data, 'original_name');
        $this->overview = $this->toString($data, 'overview');
        $this->media_type = $this->toString($data, 'media_type');
        $this->adult = $this->toBool($data, 'adult');
        $this->original_language = $this->toString($data, 'original_language');
        $this->genre_ids = $this->toArray($data, 'genre_ids');
        $this->popularity = $this->toFloat($data, 'popularity');
        $this->first_air_date = $this->toDateTime($data, 'first_air_date');
        $this->release_date = $this->toDateTime($data, 'release_date');
        $this->video = $this->toString($data, 'video');
        $this->setVotes($data);
        $this->origin_country = $this->toArray($data, 'origin_country');
        $this->character = $this->toString($data, 'character');

        $this->episodes = $this->validateData($data, 'episodes', fn (array $values) => $this->loopOn($values, Episode::class));
        $this->seasons = $this->validateData($data, 'seasons', fn (array $values) => $this->loopOn($values, Season::class));
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
     * @return Episode[]|null
     */
    public function getEpisodes(): ?array
    {
        return $this->episodes;
    }

    /**
     * @return Season[]|null
     */
    public function getSeasons(): ?array
    {
        return $this->seasons;
    }
}
