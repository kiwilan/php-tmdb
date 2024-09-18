<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Utils\TmdbUrl;

abstract class Repository
{
    protected bool $isSuccess = false;

    protected string $language = 'en-US';

    public function __construct(
        protected string $apiKey,
    ) {}

    /**
     * Merge base URL with the path and execute the request
     *
     * @param  string  $path  The path to merge
     * @param  string[]  $queryParams  The query parameters
     */
    protected function get(string $path, array $queryParams = []): ?array
    {
        return $this->execute($this->getUrl($path, $queryParams));
    }

    /**
     * Merge base URL with the path
     *
     * @param  string  $path  The path to merge
     * @param  string[]  $queryParams  The query parameters
     */
    protected function getUrl(string $path, array $queryParams = []): string
    {
        return TmdbUrl::API_V3_URL.$path.'?'.http_build_query($queryParams);
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
     */
    protected function execute(string $url): ?array
    {
        $client = new \GuzzleHttp\Client;

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
