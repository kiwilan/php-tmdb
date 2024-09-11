<?php

namespace Kiwilan\Tmdb;

class Tmdb
{
    protected function __construct(
        protected string $apiKey,
        protected string $language = 'en-US',
    ) {}

    /**
     * Create a new instance of the client
     *
     * @param  string  $apiKey  The API key for TMDB
     */
    public static function client(string $apiKey): self
    {
        return new self($apiKey);
    }

    /**
     * Set the language, default is `en-US`
     */
    public function language(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Use collections repository
     *
     * @docs https://developer.themoviedb.org/reference/collections-details
     */
    public function collections(): Repositories\CollectionsRepository
    {
        return new Repositories\CollectionsRepository($this->apiKey);
    }

    /**
     * Use companies repository
     *
     * @docs https://developer.themoviedb.org/reference/company-details
     */
    public function companies(): Repositories\CompaniesRepository
    {
        return new Repositories\CompaniesRepository($this->apiKey);
    }

    /**
     * Use credits repository
     *
     * @docs https://developer.themoviedb.org/reference/credit-details
     */
    public function credits(): Repositories\CreditsRepository
    {
        return new Repositories\CreditsRepository($this->apiKey);
    }

    /**
     * Use movie repository
     *
     * @docs https://developer.themoviedb.org/reference/movie-details
     */
    public function movies(): Repositories\MoviesRepository
    {
        return new Repositories\MoviesRepository($this->apiKey);
    }

    /**
     * Use networks repository
     *
     * @docs https://developer.themoviedb.org/reference/network-details
     */
    public function networks(): Repositories\NetworksRepository
    {
        return new Repositories\NetworksRepository($this->apiKey);
    }

    /**
     * Use search repository
     *
     * @docs https://developer.themoviedb.org/reference/search-collection
     */
    public function search(): Repositories\SearchRepository
    {
        return new Repositories\SearchRepository($this->apiKey);
    }

    /**
     * Use TVSeriesRepository repository
     *
     * @docs https://developer.themoviedb.org/reference/tv-series-details
     */
    public function tvSeries(): Repositories\TVSeriesRepository
    {
        return new Repositories\TVSeriesRepository($this->apiKey);
    }

    /**
     * Use TVSeasonRepository repository
     *
     * @docs https://developer.themoviedb.org/reference/tv-season-details
     */
    public function tvSeasons(): Repositories\TVSeasonsRepository
    {
        return new Repositories\TVSeasonsRepository($this->apiKey);
    }

    /**
     * Use TVEpisodeRepository repository
     *
     * @docs https://developer.themoviedb.org/reference/tv-episode-details
     */
    public function tvEpisodes(): Repositories\TVEpisodesRepository
    {
        return new Repositories\TVEpisodesRepository($this->apiKey);
    }
}
