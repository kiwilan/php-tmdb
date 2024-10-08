<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Traits;

abstract class TmdbExtendedMedia extends TmdbBaseMedia
{
    use Traits\TmdbAlternativeTitles;

    /** @var Common\TmdbGenre[]|null */
    protected ?array $genres = null;

    protected ?string $homepage = null;

    /** @var Common\TmdbCompany[]|null */
    protected ?array $production_companies = null;

    /** @var Common\TmdbCountry[]|null */
    protected ?array $production_countries = null;

    /** @var Common\TmdbSpokenLanguage[]|null */
    protected ?array $spoken_languages = null;

    protected ?string $status = null;

    protected ?string $tagline = null;

    /** @var Common\TmdbAlternativeTitle[]|null */
    protected ?array $alternative_titles = null;

    protected ?TmdbCredits $credits = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->setAlternativeTitles();

        $this->homepage = $this->toString('homepage');
        $this->status = $this->toString('status');
        $this->tagline = $this->toString('tagline');

        $this->credits = $this->toModel('credits', TmdbCredits::class);

        $this->genres = $this->validateData('genres', fn (array $values) => $this->loopOn($values, Common\TmdbGenre::class));
        $this->production_companies = $this->validateData('production_companies', fn (array $values) => $this->loopOn($values, Common\TmdbCompany::class));
        $this->production_countries = $this->validateData('production_countries', fn (array $values) => $this->loopOn($values, Common\TmdbCountry::class));
        $this->spoken_languages = $this->validateData('spoken_languages', fn (array $values) => $this->loopOn($values, Common\TmdbSpokenLanguage::class));
    }

    /**
     * @return Common\TmdbGenre[]|null
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
     * @return Common\TmdbCompany[]|null
     */
    public function getProductionCompanies(): ?array
    {
        return $this->production_companies;
    }

    /**
     * @return Common\TmdbCountry[]|null
     */
    public function getProductionCountries(): ?array
    {
        return $this->production_countries;
    }

    /**
     * @return Common\TmdbSpokenLanguage[]|null
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

    public function getCredits(): ?TmdbCredits
    {
        return $this->credits;
    }
}
