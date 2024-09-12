<?php

namespace Kiwilan\Tmdb\Models;

use DateTime;
use Kiwilan\Tmdb\Models\Common\Video;

class Media extends BaseMedia
{
    protected ?string $media_type = null;

    protected ?string $title = null;

    protected ?string $original_title = null;

    protected ?DateTime $release_date = null;

    /** @var Video[]|null */
    protected ?array $videos = null;

    protected ?DateTime $first_air_date = null;

    public function __construct(array $data)
    {
        $this->setId($data);
        $this->setBackdropPath($data);
        $this->setPosterPath($data);

        $this->title = $this->toString($data, 'title');
        if (! $this->title) {
            $this->title = $this->toString($data, 'name');
        }

        $this->original_title = $this->toString($data, 'original_title');
        if (! $this->original_title) {
            $this->original_title = $this->toString($data, 'original_name');
        }

        $this->adult = $this->toBool($data, 'adult');
        $this->genre_ids = $this->toArray($data, 'genre_ids');

        $this->origin_country = $this->toArray($data, 'origin_country');
        $this->original_language = $this->toString($data, 'original_language');

        $this->overview = $this->toString($data, 'overview');
        $this->popularity = $this->toFloat($data, 'popularity');

        $this->vote_average = $this->toFloat($data, 'vote_average');
        $this->vote_count = $this->toInt($data, 'vote_count');

        $this->media_type = $this->toString($data, 'media_type');
        $this->release_date = $this->toDateTime($data, 'release_date');
        $this->first_air_date = $this->toDateTime($data, 'first_air_date');

        $this->videos = $this->validateData($data, 'videos', fn (array $values) => $this->loopOn($values, Video::class));
    }

    public function isAdult(): bool
    {
        return $this->adult;
    }

    /**
     * @return int[]|null
     */
    public function getGenreIds(): ?array
    {
        return $this->genre_ids;
    }

    public function getOriginalLanguage(): ?string
    {
        return $this->original_language;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    public function getVoteCount(): ?int
    {
        return $this->vote_count;
    }

    public function getMediaType(): ?string
    {
        return $this->media_type;
    }

    public function getReleaseDate(): ?DateTime
    {
        return $this->release_date;
    }

    /**
     * @return Video[]|null
     */
    public function getVideos(): ?array
    {
        return $this->videos;
    }

    public function getFirstAirDate(): ?DateTime
    {
        return $this->first_air_date;
    }

    /**
     * Get title of movie or name of tv series.
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Get original title of movie or original name of tv series.
     */
    public function getOriginalTitle(): ?string
    {
        return $this->original_title;
    }

    /**
     * @return string[]|null
     */
    public function getOriginCountry(): ?array
    {
        return $this->origin_country;
    }

    public function isMovie(): bool
    {
        return $this->media_type === 'movie';
    }

    public function isTv(): bool
    {
        return $this->media_type === 'tv';
    }
}
