<?php

namespace Kiwilan\Tmdb;

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
     */
    public function searchMovie(string $query, Query\SearchMovieQuery $params = new Query\SearchMovieQuery): \Kiwilan\Tmdb\Models\Search\SearchMovies
    {
        $url = 'https://api.themoviedb.org/3/search/movie';
        $queryParams = [
            'query' => $query,
            ...$params->toQueryParams(),
        ];

        $response = $this->execute($url, $queryParams);

        return new \Kiwilan\Tmdb\Models\Search\SearchMovies($response);
    }

    /**
     * Search movies
     *
     * @param  string  $query  The search query
     * @param  Query\SearchTvSeriesQuery  $params  The search query parameters for additional information
     */
    public function searchTvSeries(string $query, Query\SearchTvSeriesQuery $params = new Query\SearchTvSeriesQuery): \Kiwilan\Tmdb\Models\Search\SearchMovies
    {
        $url = ' https://api.themoviedb.org/3/search/tv';
        $queryParams = [
            'query' => $query,
            ...$params->toQueryParams(),
        ];

        $response = $this->execute($url, $queryParams);

        return new \Kiwilan\Tmdb\Models\Search\SearchMovies($response);
    }

    /**
     * Get movie details
     *
     * @param  int  $movieId  The TMDB movie ID
     * @param  string|null  $appendToResponse  To get additional information
     */
    public function getMovie(int $movieId, ?string $appendToResponse = null): ?\Kiwilan\Tmdb\Models\Movie
    {
        $url = "https://api.themoviedb.org/3/movie/{$movieId}";
        $queryParams = [
            'append_to_response' => $appendToResponse,
            'language' => $this->language,
        ];

        $response = $this->execute($url, $queryParams);

        return $this->isSuccess ? new \Kiwilan\Tmdb\Models\Movie($response) : null;
    }

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
