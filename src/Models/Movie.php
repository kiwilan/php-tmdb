<?php

namespace Kiwilan\Tmdb\Models;

use DateTime;
use Kiwilan\Tmdb\Models\Movie\ReleaseDate;

class Movie extends Media
{
    protected ?Movie\BelongsToCollection $belongs_to_collection = null;

    protected ?int $budget = null;

    protected ?string $imdb_id = null;

    protected ?string $original_title = null;

    protected ?string $title = null;

    protected ?DateTime $release_date = null;

    protected ?int $revenue = null;

    protected ?int $runtime = null;

    protected mixed $video = false;

    /** @var Movie\ReleaseDate[]|null */
    protected ?array $release_dates = null;

    protected ?Search\SearchMovies $recommendations = null;

    protected ?Search\SearchMovies $similar = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $belongs_to_collection = $this->toArray($data, 'belongs_to_collection');
        $this->belongs_to_collection = $belongs_to_collection ? new Movie\BelongsToCollection($belongs_to_collection) : null;

        $this->budget = $this->toInt($data, 'budget');
        $this->imdb_id = $this->toString($data, 'imdb_id');
        $this->original_title = $this->toString($data, 'original_title');
        $this->title = $this->toString($data, 'title');
        $this->release_date = $this->toDateTime($data, 'release_date');
        $this->revenue = $this->toInt($data, 'revenue');
        $this->runtime = $this->toInt($data, 'runtime');
        $this->video = $data['video'] ?? false;

        $this->validateData($data, 'release_dates', function (array $values) {
            $this->release_dates = $this->loopOn($values['results'] ?? null, ReleaseDate::class);
        });

        if (isset($data['recommendations'])) {
            $this->recommendations = new Search\SearchMovies($data['recommendations']);
        }

        if (isset($data['similar'])) {
            $this->similar = new Search\SearchMovies($data['similar']);
        }
    }

    public function getBelongsToCollection(): ?Movie\BelongsToCollection
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

    public function isVideo(): bool
    {
        return $this->video;
    }

    /**
     * @return Movie\ReleaseDate[]|null
     */
    public function getReleaseDates(): ?array
    {
        return $this->release_dates;
    }

    public function getReleaseDatesSpecific(string $iso_3166_1): ?Movie\ReleaseDate
    {
        if (! $this->release_dates) {
            return null;
        }

        foreach ($this->release_dates as $release_date) {
            if ($release_date->getIso31661() === $iso_3166_1) {
                return $release_date;
            }
        }

        return null;
    }

    public function getRecommendations(): ?Search\SearchMovies
    {
        return $this->recommendations;
    }

    public function getSimilar(): ?Search\SearchMovies
    {
        return $this->similar;
    }
}
