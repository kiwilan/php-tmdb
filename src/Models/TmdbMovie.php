<?php

namespace Kiwilan\Tmdb\Models;

use DateTime;
use Kiwilan\Tmdb\Models\Common\TmdbVideo;
use Kiwilan\Tmdb\Models\Credits\TmdbCrew;
use Kiwilan\Tmdb\Models\Movie\TmdbReleaseDate;
use Kiwilan\Tmdb\Results\MovieResults;
use Kiwilan\Tmdb\Traits;

/**
 * Movie
 */
class TmdbMovie extends TmdbExtendedMedia
{
    use Traits\TmdbTmdbUrl;
    use Traits\TmdbTranslations;

    protected ?TmdbCollection $belongs_to_collection = null;

    protected ?int $budget = null;

    protected ?string $imdb_id = null;

    protected ?string $original_title = null;

    protected ?string $title = null;

    protected ?DateTime $release_date = null;

    protected ?int $revenue = null;

    protected ?int $runtime = null;

    /** @var TmdbVideo[]|null */
    protected ?array $videos = null;

    /** @var Movie\TmdbReleaseDate[]|null */
    protected ?array $release_dates = null;

    protected ?MovieResults $recommendations = null;

    protected ?MovieResults $similar = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->belongs_to_collection = $this->toModel('belongs_to_collection', TmdbCollection::class);
        $this->budget = $this->toInt('budget');
        $this->imdb_id = $this->toString('imdb_id');
        $this->original_title = $this->toString('original_title');
        $this->title = $this->toString('title');
        $this->release_date = $this->toDateTime('release_date');
        $this->revenue = $this->toInt('revenue');
        $this->runtime = $this->toInt('runtime');

        $this->videos = $this->validateData('videos', fn (array $values) => $this->loopOn($values['results'] ?? null, TmdbVideo::class));
        $this->release_dates = $this->validateData('release_dates', fn (array $values) => $this->loopOn($values['results'] ?? null, TmdbReleaseDate::class));

        $this->origin_country = $this->toArray('origin_country');
        $this->recommendations = $this->toModel('recommendations', MovieResults::class);
        $this->similar = $this->toModel('similar', MovieResults::class);
        $this->translations = $this->parseTranslations();
    }

    /**
     * Get movie's collection, you can use `getCollection()` instead.
     */
    public function getBelongsToCollection(): ?TmdbCollection
    {
        return $this->belongs_to_collection;
    }

    /**
     * Get movie's collection, you can use `getBelongsToCollection()` instead.
     */
    public function getCollection(): ?TmdbCollection
    {
        return $this->belongs_to_collection;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function getImdbId(): ?string
    {
        return $this->imdb_id;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->original_title;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getReleaseDate(): ?DateTime
    {
        return $this->release_date;
    }

    public function getRevenue(): ?int
    {
        return $this->revenue;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    /**
     * Get movie videos, `videos` must be requested.
     *
     * @return TmdbVideo[]|null
     */
    public function getVideos(): ?array
    {
        return $this->videos;
    }

    /**
     * Get first teaser video, `videos` must be requested.
     *
     * Teaser video is a video with type `Teaser`, if there is no teaser video, it will return `null`.
     */
    public function getVideoTeaser(): ?TmdbVideo
    {
        if (! $this->videos || empty($this->videos)) {
            return null;
        }

        foreach ($this->videos as $video) {
            if ($video->getType() === 'Teaser') {
                return $video;
            }
        }

        return null;
    }

    /**
     * @return Movie\TmdbReleaseDate[]|null
     */
    public function getReleaseDates(): ?array
    {
        return $this->release_dates;
    }

    /**
     * Get movie release date specific to a country, `release_dates` must be requested.
     *
     * @param  string  $iso_3166_1  The ISO 3166-1 code, like `US`
     */
    public function getReleaseDateSpecific(string $iso_3166_1): ?Movie\TmdbReleaseDate
    {
        if (! $this->release_dates || empty($this->release_dates)) {
            return null;
        }

        foreach ($this->release_dates as $release_date) {
            if ($release_date->getIso3166() === $iso_3166_1) {
                return $release_date;
            }
        }

        return null;
    }

    public function getRecommendations(): ?MovieResults
    {
        return $this->recommendations;
    }

    public function getSimilar(): ?MovieResults
    {
        return $this->similar;
    }

    /**
     * Get movie directors, `credits` must be requested.
     *
     * @return TmdbCrew[]|null
     */
    public function getDirectors(): ?array
    {
        if (! $this->credits) {
            return null;
        }

        $directors = [];
        if ($this->credits->getCrew()) {
            foreach ($this->credits->getCrew() as $crew) {
                if ($crew->getJob() === 'Director') {
                    $directors[] = $crew;
                }
            }
        }

        return $directors;
    }
}
