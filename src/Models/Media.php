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
        parent::__construct($data);

        $this->title = $this->toString($data, 'title');
        if (! $this->title) {
            $this->title = $this->toString($data, 'name');
        }

        $this->original_title = $this->toString($data, 'original_title');
        if (! $this->original_title) {
            $this->original_title = $this->toString($data, 'original_name');
        }

        $this->media_type = $this->toString($data, 'media_type');
        $this->release_date = $this->toDateTime($data, 'release_date');
        $this->first_air_date = $this->toDateTime($data, 'first_air_date');

        $this->videos = $this->validateData($data, 'videos', fn (array $values) => $this->loopOn($values, Video::class));
    }

    /**
     * Get the media type, to know if it's a movie or a tv series. You can use `isMovie()` or `isTv()` to know the type.
     */
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

    public function isMovie(): bool
    {
        return $this->media_type === 'movie';
    }

    public function isTv(): bool
    {
        return $this->media_type === 'tv';
    }
}
