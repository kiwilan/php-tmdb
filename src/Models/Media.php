<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Models\Common\AlternativeTitle;
use Kiwilan\Tmdb\Models\Common\Company;
use Kiwilan\Tmdb\Models\Common\Country;
use Kiwilan\Tmdb\Models\Common\Genre;
use Kiwilan\Tmdb\Models\Common\SpokenLanguage;
use Kiwilan\Tmdb\Traits\HasAlternativeTitles;
use Kiwilan\Tmdb\Traits\HasBackdrop;
use Kiwilan\Tmdb\Traits\HasId;
use Kiwilan\Tmdb\Traits\HasPoster;

class Media extends TmdbModel
{
    use HasAlternativeTitles;
    use HasBackdrop;
    use HasId;
    use HasPoster;

    protected bool $adult = false;

    /** @var int[]|null */
    protected ?array $genre_ids = null;

    /** @var Genre[]|null */
    protected ?array $genres = null;

    protected ?string $homepage = null;

    /** @var string[]|null */
    protected ?array $origin_country = null;

    protected ?string $original_language = null;

    protected ?string $overview = null;

    protected ?float $popularity = null;

    /** @var Company[]|null */
    protected ?array $production_companies = null;

    /** @var Country[]|null */
    protected ?array $production_countries = null;

    /** @var SpokenLanguage[]|null */
    protected ?array $spoken_languages = null;

    protected ?string $status = null;

    protected ?string $tagline = null;

    protected ?float $vote_average = null;

    protected ?int $vote_count = null;

    /** @var AlternativeTitle[]|null */
    protected ?array $alternative_titles = null;

    protected ?Credits $credits = null;

    public function __construct(array $data)
    {
        $this->setId($data);
        $this->setBackdropPath($data);
        $this->setPosterPath($data);
        $this->setAlternativeTitles($data);

        $this->adult = $this->toBool($data, 'adult');
        $this->homepage = $this->toString($data, 'homepage');
        $this->origin_country = $this->toArray($data, 'origin_country');
        $this->original_language = $this->toString($data, 'original_language');
        $this->overview = $this->toString($data, 'overview');
        $this->popularity = $this->toFloat($data, 'popularity');
        $this->status = $this->toString($data, 'status');
        $this->tagline = $this->toString($data, 'tagline');
        $this->vote_average = $this->toFloat($data, 'vote_average');
        $this->vote_count = $this->toInt($data, 'vote_count');

        $this->genre_ids = $this->toArray($data, 'genre_ids');
        $this->genres = $this->validateData($data, 'genres', fn (array $values) => $this->loopOn($values, Genre::class));
        $this->production_companies = $this->validateData($data, 'production_companies', fn (array $values) => $this->loopOn($values, Company::class));
        $this->production_countries = $this->validateData($data, 'production_countries', fn (array $values) => $this->loopOn($values, Country::class));
        $this->spoken_languages = $this->validateData($data, 'spoken_languages', fn (array $values) => $this->loopOn($values, SpokenLanguage::class));

        $this->credits = $this->toModel($data, 'credits', Credits::class);
    }

    public function isAdult(): bool
    {
        return $this->adult;
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

    /**
     * Get the origin countries.
     *
     * @return string[]|null
     */
    public function getOriginCountry(): ?array
    {
        return $this->origin_country;
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

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    public function getVoteCount(): ?int
    {
        return $this->vote_count;
    }

    public function getCredits(): ?Credits
    {
        return $this->credits;
    }
}
