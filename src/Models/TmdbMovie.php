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
    use Traits\TmdbHasTmdbUrl;

    protected ?Movie\TmdbBelongsToCollection $belongs_to_collection = null;

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

        $this->belongs_to_collection = $this->toModel($data, 'belongs_to_collection', Movie\TmdbBelongsToCollection::class);
        $this->budget = $this->toInt($data, 'budget');
        $this->imdb_id = $this->toString($data, 'imdb_id');
        $this->original_title = $this->toString($data, 'original_title');
        $this->title = $this->toString($data, 'title');
        $this->release_date = $this->toDateTime($data, 'release_date');
        $this->revenue = $this->toInt($data, 'revenue');
        $this->runtime = $this->toInt($data, 'runtime');

        $this->videos = $this->validateData($data, 'videos', fn (array $values) => $this->loopOn($values['results'] ?? null, TmdbVideo::class));
        $this->release_dates = $this->validateData($data, 'release_dates', fn (array $values) => $this->loopOn($values['results'] ?? null, TmdbReleaseDate::class));

        $this->origin_country = $this->toArray($data, 'origin_country');
        $this->recommendations = $this->toModel($data, 'recommendations', MovieResults::class);
        $this->similar = $this->toModel($data, 'similar', MovieResults::class);
    }

    public function getBelongsToCollection(): ?Movie\TmdbBelongsToCollection
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
            if ($release_date->getIso31661() === $iso_3166_1) {
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