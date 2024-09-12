<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Models\Common\AlternativeTitle;
use Kiwilan\Tmdb\Models\Common\Company;
use Kiwilan\Tmdb\Models\Common\Country;
use Kiwilan\Tmdb\Models\Common\Genre;
use Kiwilan\Tmdb\Models\Common\SpokenLanguage;
use Kiwilan\Tmdb\Traits\HasAlternativeTitles;

abstract class ExtendedMedia extends BaseMedia
{
    use HasAlternativeTitles;

    /** @var Genre[]|null */
    protected ?array $genres = null;

    protected ?string $homepage = null;

    /** @var Company[]|null */
    protected ?array $production_companies = null;

    /** @var Country[]|null */
    protected ?array $production_countries = null;

    /** @var SpokenLanguage[]|null */
    protected ?array $spoken_languages = null;

    protected ?string $status = null;

    protected ?string $tagline = null;

    /** @var AlternativeTitle[]|null */
    protected ?array $alternative_titles = null;

    protected ?Credits $credits = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->setAlternativeTitles($data);

        $this->homepage = $this->toString($data, 'homepage');
        $this->status = $this->toString($data, 'status');
        $this->tagline = $this->toString($data, 'tagline');

        $this->credits = $this->toModel($data, 'credits', Credits::class);

        $this->genres = $this->validateData($data, 'genres', fn (array $values) => $this->loopOn($values, Genre::class));
        $this->production_companies = $this->validateData($data, 'production_companies', fn (array $values) => $this->loopOn($values, Company::class));
        $this->production_countries = $this->validateData($data, 'production_countries', fn (array $values) => $this->loopOn($values, Country::class));
        $this->spoken_languages = $this->validateData($data, 'spoken_languages', fn (array $values) => $this->loopOn($values, SpokenLanguage::class));
    }

    /**
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
     * @return Company[]|null
     */
    public function getProductionCompanies(): ?array
    {
        return $this->production_companies;
    }

    /**
     * @return Country[]|null
     */
    public function getProductionCountries(): ?array
    {
        return $this->production_countries;
    }

    /**
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

    public function getCredits(): ?Credits
    {
        return $this->credits;
    }
}
