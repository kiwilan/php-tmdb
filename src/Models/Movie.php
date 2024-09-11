<?php

namespace Kiwilan\Tmdb\Models;

class Movie
{
    protected bool $adult = false;

    protected ?string $backdrop_path = null;

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

    protected ?string $poster_path = null;

    /** @var ProductionCompany[]|null */
    protected ?array $production_companies = null;

    /** @var ProductionCountry[]|null */
    protected ?array $production_countries = null;

    protected ?string $release_date = null;

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

    protected ?AlternativeTitles $alternative_titles = null;

    protected ?Credits $credits = null;

    protected ?MovieReleaseDates $release_dates = null;

    protected ?MovieRecommendations $recommendations = null;

    protected ?MovieSimilar $similar = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $belongs_to_collection = $data['belongs_to_collection'] ?? null;

        $this->adult = $data['adult'] ? boolval($data['adult']) : false;
        $this->backdrop_path = $data['backdrop_path'] ?? null;
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
        $this->poster_path = $data['poster_path'] ?? null;
        $this->production_companies = [];
        if (isset($data['production_companies']) && is_array($data['production_companies'])) {
            foreach ($data['production_companies'] as $companyData) {
                $this->production_companies[] = new ProductionCompany($companyData);
            }
        }
        $this->production_countries = [];
        if (isset($data['production_countries']) && is_array($data['production_countries'])) {
            foreach ($data['production_countries'] as $countryData) {
                $this->production_countries[] = new ProductionCountry($countryData);
            }
        }
        $this->release_date = $data['release_date'] ?? null;
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
            // $this->alternative_titles = new AlternativeTitle($data['alternative_titles']);
        }

        if (isset($data['credits'])) {
            // $this->credits = new Credits($data['credits']);
        }

        if (isset($data['release_dates'])) {
            $this->release_dates = new MovieReleaseDates($data['release_dates']);
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

    public function getBackdropPath(): ?string
    {
        return $this->backdrop_path;
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

    public function getPosterPath(): ?string
    {
        return $this->poster_path;
    }

    /**
     * Get the production companies.
     *
     * @return ProductionCompany[]|null
     */
    public function getProductionCompanies(): ?array
    {
        return $this->production_companies;
    }

    /**
     * Get the production countries.
     *
     * @return ProductionCountry[]|null
     */
    public function getProductionCountries(): ?array
    {
        return $this->production_countries;
    }

    public function getReleaseDate(): ?string
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

    public function getAlternativeTitles(): ?AlternativeTitles
    {
        return $this->alternative_titles;
    }

    public function getCredits(): ?Credits
    {
        return $this->credits;
    }

    public function getReleaseDates(): ?MovieReleaseDates
    {
        return $this->release_dates;
    }

    public function getRecommendations(): ?MovieRecommendations
    {
        return $this->recommendations;
    }

    public function getSimilar(): ?MovieSimilar
    {
        return $this->similar;
    }
}
