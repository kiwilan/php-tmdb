<?php

namespace Kiwilan\Tmdb\Models;

use DateTime;
use Kiwilan\Tmdb\Traits\HasBackdrop;
use Kiwilan\Tmdb\Traits\HasPoster;

class Movie
{
    use HasBackdrop;
    use HasPoster;

    protected bool $adult = false;

    protected ?Movie\BelongsToCollection $belongs_to_collection = null;

    protected ?int $budget = null;

    /** @var int[]|null */
    protected ?array $genre_ids = null;

    /** @var Genre[]|null */
    protected ?array $genres = null;

    protected ?string $homepage = null;

    protected ?int $id = null;

    protected ?string $imdb_id = null;

    protected ?string $original_language = null;

    protected ?string $original_title = null;

    protected ?string $overview = null;

    protected ?float $popularity = null;

    /** @var Company[]|null */
    protected ?array $production_companies = null;

    /** @var Country[]|null */
    protected ?array $production_countries = null;

    protected ?DateTime $release_date = null;

    protected ?int $revenue = null;

    protected ?int $runtime = null;

    /** @var SpokenLanguage[]|null */
    protected ?array $spoken_languages = null;

    protected ?string $status = null;

    protected ?string $tagline = null;

    protected ?string $title = null;

    protected bool $video = false;

    protected ?float $vote_average = null;

    protected ?int $vote_count = null;

    /** @var Movie\AlternativeTitle[]|null */
    protected ?array $alternative_titles = null;

    protected ?Credits $credits = null;

    /** @var Movie\ReleaseDate[]|null */
    protected ?array $release_dates = null;

    protected ?Search\SearchMovies $recommendations = null;

    protected ?Search\SearchMovies $similar = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $belongs_to_collection = $data['belongs_to_collection'] ?? null;

        $this->adult = $data['adult'] ? boolval($data['adult']) : false;

        $this->setBackdropPath($data);

        $this->belongs_to_collection = $belongs_to_collection ? new Movie\BelongsToCollection($belongs_to_collection) : null;
        $this->budget = $data['budget'] ?? null;
        $this->genre_ids = $data['genre_ids'] ?? null;
        $this->genres = [];
        if (isset($data['genres']) && is_array($data['genres'])) {
            foreach ($data['genres'] as $genreData) {
                $this->genres[] = new Genre($genreData);
            }
        }
        $this->homepage = $data['homepage'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->imdb_id = $data['imdb_id'] ?? null;
        $this->original_language = $data['original_language'] ?? null;
        $this->original_title = $data['original_title'] ?? null;
        $this->overview = $data['overview'] ?? null;
        $this->popularity = $data['popularity'] ?? null;

        $this->setPosterPath($data);

        $this->production_companies = [];
        if (isset($data['production_companies']) && is_array($data['production_companies'])) {
            foreach ($data['production_companies'] as $companyData) {
                $this->production_companies[] = new Company($companyData);
            }
        }
        $this->production_countries = [];
        if (isset($data['production_countries']) && is_array($data['production_countries'])) {
            foreach ($data['production_countries'] as $countryData) {
                $this->production_countries[] = new Country($countryData);
            }
        }
        $release_date = $data['release_date'] ?? null;
        $this->release_date = $release_date ? new DateTime($release_date) : null;
        $this->revenue = $data['revenue'] ?? null;
        $this->runtime = $data['runtime'] ?? null;
        $this->spoken_languages = [];
        if (isset($data['spoken_languages']) && is_array($data['spoken_languages'])) {
            foreach ($data['spoken_languages'] as $languageData) {
                $this->spoken_languages[] = new SpokenLanguage($languageData);
            }
        }
        $this->status = $data['status'] ?? null;
        $this->tagline = $data['tagline'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->video = $data['video'] ?? false;
        $this->vote_average = $data['vote_average'] ?? null;
        $this->vote_count = $data['vote_count'] ?? null;

        if (isset($data['alternative_titles'])) {
            $alternative_titles = $data['alternative_titles']['titles'] ?? [];
            foreach ($alternative_titles as $alternative_title) {
                $this->alternative_titles[] = new Movie\AlternativeTitle($alternative_title);
            }
        }

        if (isset($data['credits'])) {
            // $this->credits = new Credits($data['credits']);
        }

        if (isset($data['release_dates'])) {
            $release_dates = $data['release_dates']['results'] ?? [];
            foreach ($release_dates as $release_date) {
                $this->release_dates[] = new Movie\ReleaseDate($release_date);
            }
        }

        if (isset($data['recommendations'])) {
            // $this->recommendations = new MovieRecommendations($data['recommendations']);
        }

        if (isset($data['similar'])) {
            // $this->similar = new MovieSimilar($data['similar']);
        }
    }

    public function isAdult(): bool
    {
        return $this->adult;
    }

    public function getBelongsToCollection(): ?Movie\BelongsToCollection
    {
        return $this->belongs_to_collection;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    /**
     * Get the genre IDs.
     *
     * @return int[]|null
     */
    public function getGenreIds(): ?array
    {
        return $this->genre_ids;
    }

    /**
     * Get the genres.
     *
     * @return Genre[]|null
     */
    public function getGenres(): ?array
    {
        return $this->genres;
    }

    public function getHomepage(): ?string
    {
        return $this->homepage;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImdbId(): ?string
    {
        return $this->imdb_id;
    }

    public function getOriginalLanguage(): ?string
    {
        return $this->original_language;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->original_title;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    /**
     * Get the production companies.
     *
     * @return Company[]|null
     */
    public function getProductionCompanies(): ?array
    {
        return $this->production_companies;
    }

    /**
     * Get the production countries.
     *
     * @return Country[]|null
     */
    public function getProductionCountries(): ?array
    {
        return $this->production_countries;
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
     * Get the spoken languages.
     *
     * @return SpokenLanguage[]|null
     */
    public function getSpokenLanguages(): ?array
    {
        return $this->spoken_languages;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getTagline(): ?string
    {
        return $this->tagline;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function isVideo(): bool
    {
        return $this->video;
    }

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    public function getVoteCount(): ?int
    {
        return $this->vote_count;
    }

    /**
     * Get the alternative titles.
     *
     * @return Movie\AlternativeTitle[]|null
     */
    public function getAlternativeTitles(): ?array
    {
        return $this->alternative_titles;
    }

    /**
     * Get the alternative title by ISO 3166-1 code.
     *
     * - If not found, return null.
     * - If duplicate, return the first one.
     */
    public function getAlternativeTitle(string $iso_3166_1): ?Movie\AlternativeTitle
    {
        if (! $this->alternative_titles) {
            return null;
        }

        foreach ($this->alternative_titles as $alternative_title) {
            if ($alternative_title->getIso31661() === $iso_3166_1) {
                return $alternative_title;
            }
        }

        return null;
    }

    public function getCredits(): ?Credits
    {
        return $this->credits;
    }

    /**
     * Get the release dates.
     *
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
