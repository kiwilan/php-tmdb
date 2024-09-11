<?php

namespace Kiwilan\Tmdb;

use Kiwilan\Tmdb\Models\Collection;
use Kiwilan\Tmdb\Models\Common\Company;
use Kiwilan\Tmdb\Models\Credits;
use Kiwilan\Tmdb\Models\Movie;
use Kiwilan\Tmdb\Models\Search\SearchCollections;
use Kiwilan\Tmdb\Models\Search\SearchMovies;
use Kiwilan\Tmdb\Models\Search\SearchTvSeries;
use Kiwilan\Tmdb\Models\TvSeries;
use Kiwilan\Tmdb\Models\TvSeries\Episode;
use Kiwilan\Tmdb\Models\TvSeries\Network;
use Kiwilan\Tmdb\Models\TvSeries\Season;

class Tmdb
{
    const BASE_URL = 'https://api.themoviedb.org/3';

    protected function __construct(
        protected string $apiKey,
        protected string $language = 'en-US',
        protected bool $isSuccess = false,
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
     * Search movies
     *
     * @param  string  $query  The search query
     * @param  Query\SearchMovieQuery  $params  The search query parameters for additional information
     *
     * @docs https://developer.themoviedb.org/reference/search-movie
     */
    public function searchMovie(string $query, Query\SearchMovieQuery $params = new Query\SearchMovieQuery): SearchMovies
    {
        $url = $this->getUrl('/search/movie');
        $queryParams = [
            'query' => $query,
            ...$params->toQueryParams(),
        ];

        $response = $this->execute($url, $queryParams);

        return new SearchMovies($response);
    }

    /**
     * Search movies
     *
     * @param  string  $query  The search query
     * @param  Query\SearchTvSeriesQuery  $params  The search query parameters for additional information
     *
     * @docs https://developer.themoviedb.org/reference/search-tv
     */
    public function searchTvSeries(string $query, Query\SearchTvSeriesQuery $params = new Query\SearchTvSeriesQuery): SearchTvSeries
    {
        $url = $this->getUrl('/search/tv');
        $queryParams = [
            'query' => $query,
            ...$params->toQueryParams(),
        ];

        $response = $this->execute($url, $queryParams);

        return new SearchTvSeries($response);
    }

    /**
     * Search collections
     *
     * @param  string  $query  The search query
     * @param  Query\SearchCollectionQuery  $params  The search query parameters for additional information
     *
     * @docs https://developer.themoviedb.org/reference/search-collection
     */
    public function searchCollections(string $query, Query\SearchCollectionQuery $params = new Query\SearchCollectionQuery): SearchCollections
    {
        $url = $this->getUrl('/search/collection');
        $queryParams = [
            'query' => $query,
            ...$params->toQueryParams(),
        ];

        $response = $this->execute($url, $queryParams);

        return new SearchCollections($response);
    }

    /**
     * Get network details
     *
     * @param  int  $network_id  The TMDB network ID
     *
     * @docs https://developer.themoviedb.org/reference/network-details
     */
    public function getNetwork(int $network_id): ?Network
    {
        $url = $this->getUrl("/network/{$network_id}");

        $response = $this->execute($url);

        return $this->isSuccess ? new Network($response) : null;
    }

    /**
     * Get movie details
     *
     * @param  int  $movie_id  The TMDB movie ID
     * @param  string|null  $append_to_response  To get additional information
     *
     * @docs https://developer.themoviedb.org/reference/movie-details
     */
    public function getMovie(int $movie_id, ?string $append_to_response = null): ?Movie
    {
        $url = $this->getUrl("/movie/{$movie_id}");
        $queryParams = [
            'append_to_response' => $append_to_response,
            'language' => $this->language,
        ];

        $response = $this->execute($url, $queryParams);

        return $this->isSuccess ? new Movie($response) : null;
    }

    /**
     * Get TV series details
     *
     * @param  int  $series_id  The TMDB TV series ID
     * @param  string|null  $append_to_response  To get additional information
     *
     * @docs https://developer.themoviedb.org/reference/tv-series-details
     */
    public function getTVSeries(int $series_id, ?string $append_to_response = null): ?TvSeries
    {
        $url = $this->getUrl("/tv/{$series_id}");
        $queryParams = [
            'append_to_response' => $append_to_response,
            'language' => $this->language,
        ];

        $response = $this->execute($url, $queryParams);

        return $this->isSuccess ? new TvSeries($response) : null;
    }

    /**
     * Get season details
     *
     * @param  int  $series_id  The TMDB TV series ID
     * @param  int  $season_number  The season number
     * @param  string|null  $append_to_response  To get additional information
     *
     * @docs https://developer.themoviedb.org/reference/tv-season-details
     */
    public function getSeason(int $series_id, int $season_number, ?string $append_to_response = null): ?Season
    {
        $url = $this->getUrl("/tv/{$series_id}/season/{$season_number}");
        $queryParams = [
            'append_to_response' => $append_to_response,
            'language' => $this->language,
        ];

        $response = $this->execute($url, $queryParams);

        return $this->isSuccess ? new Season($response) : null;
    }

    /**
     * Get episode details
     *
     * @param  int  $series_id  The TMDB TV series ID
     * @param  int  $season_number  The season number
     * @param  int  $episode_number  The episode number
     * @param  string|null  $append_to_response  To get additional information
     *
     * @docs https://developer.themoviedb.org/reference/tv-episode-details
     */
    public function getEpisode(int $series_id, int $season_number, int $episode_number, ?string $append_to_response = null): ?Episode
    {
        $url = $this->getUrl("/tv/{$series_id}/season/{$season_number}/episode/{$episode_number}");
        $queryParams = [
            'append_to_response' => $append_to_response,
            'language' => $this->language,
        ];

        $response = $this->execute($url, $queryParams);

        return $this->isSuccess ? new Episode($response) : null;
    }

    /**
     * Get collection details
     *
     * @param  int  $collection_id  The TMDB collection ID
     * @param  ?string  $language  The language to get the collection details (can override the default language)
     *
     * @docs https://developer.themoviedb.org/reference/collection-details
     */
    public function getCollection(int $collection_id, ?string $language = null): ?Collection
    {
        $url = $this->getUrl("/collection/{$collection_id}");
        $queryParams = [
            'language' => $language ?? $this->language,
        ];

        $response = $this->execute($url, $queryParams);

        return $this->isSuccess ? new Collection($response) : null;
    }

    /**
     * Get company details
     *
     * @param  int  $company_id  The TMDB company ID
     */
    public function getCompany(int $company_id): ?Company
    {
        $url = $this->getUrl("/company/{$company_id}");

        $response = $this->execute($url);

        return $this->isSuccess ? new Company($response) : null;
    }

    /**
     * Get credits details
     *
     * @param  int  $credit_id  The TMDB credit ID
     */
    public function getCredits(int $credit_id): ?Credits
    {
        $url = $this->getUrl("/credit/{$credit_id}");

        $response = $this->execute($url);

        return $this->isSuccess ? new Credits($response) : null;
    }

    /**
     * Merge base URL with the path
     */
    private function getUrl(string $path): string
    {
        return self::BASE_URL.$path;
    }

    /**
     * Execute the request
     *
     * @param  string  $url  The URL to request
     * @param  string[]  $queryParams  The query parameters
     */
    private function execute(string $url, array $queryParams = []): ?array
    {
        $client = new \GuzzleHttp\Client;

        $url = $url.'?'.http_build_query($queryParams);
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
            ],
            'http_errors' => false,
        ]);

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $this->isSuccess = true;

        return json_decode($response->getBody()->getContents(), true);
    }
}
