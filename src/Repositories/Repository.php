<?php

namespace Kiwilan\Tmdb\Repositories;

abstract class Repository
{
    protected const BASE_URL = 'https://api.themoviedb.org/3';

    protected bool $isSuccess = false;

    protected string $language = 'en-US';

    public function __construct(
        protected string $apiKey,
    ) {}

    /**
     * Merge base URL with the path
     */
    protected function getUrl(string $path): string
    {
        return self::BASE_URL.$path;
    }

    /**
     * Append the query parameters
     *
     * @param  string[]|null  $append_to_response  To get additional information
     */
    protected function appendToResponse(?array $append_to_response): string
    {
        return $append_to_response ? implode(',', $append_to_response) : '';
    }

    /**
     * Execute the request
     *
     * @param  string  $url  The URL to request
     * @param  string[]  $queryParams  The query parameters
     */
    protected function execute(string $url, array $queryParams = []): ?array
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
