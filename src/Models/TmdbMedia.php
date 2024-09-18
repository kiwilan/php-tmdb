<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Enums\TmdbMediaType;
use Kiwilan\Tmdb\Models\Credits\TmdbPerson;
use Kiwilan\Tmdb\Traits\TmdbHasId;

/**
 * Movie, TV Series or Person
 */
class TmdbMedia extends TmdbModel
{
    use TmdbHasId;

    protected ?TmdbMediaType $media_type = TmdbMediaType::MOVIE; // common

    protected ?TmdbPerson $person = null; // person

    protected ?TmdbMovie $movie = null; // movie

    protected ?TmdbTvSeries $tv_series = null; // tv-show

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->media_type = TmdbMediaType::tryFrom($data['media_type']);

        if ($this->media_type === TmdbMediaType::MOVIE) {
            $this->movie = new TmdbMovie($data);
        } elseif ($this->media_type === TmdbMediaType::TV) {
            $this->tv_series = new TmdbTvSeries($data);
        } elseif ($this->media_type === TmdbMediaType::PERSON) {
            $this->person = new TmdbPerson($data);
        }
    }

    /**
     * Get the media type: movie, tv-show or person
     */
    public function getMediaType(): TmdbMediaType
    {
        return $this->media_type;
    }

    public function isMovie(): bool
    {
        return $this->media_type === TmdbMediaType::MOVIE;
    }

    public function isTvSeries(): bool
    {
        return $this->media_type === TmdbMediaType::TV;
    }

    public function isPerson(): bool
    {
        return $this->media_type === TmdbMediaType::PERSON;
    }

    public function getPerson(): ?TmdbPerson
    {
        return $this->person;
    }

    public function getMovie(): ?TmdbMovie
    {
        return $this->movie;
    }

    public function getTvSeries(): ?TmdbTvSeries
    {
        return $this->tv_series;
    }

    public function getTitle(): ?string
    {
        return $this->getMovie()?->getTitle() ?? $this->getTvSeries()?->getName() ?? $this->getPerson()?->getName();
    }
}
