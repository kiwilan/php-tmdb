<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Utils\TmdbUrl;

abstract class Repository
{
    protected ?string $url = null;

    protected ?array $body = null;

    protected bool $isSuccess = false;

    protected string $language = 'en-US';

    public function __construct(
        private string $apiKey,
    ) {}

    /**
     * Merge base URL with the path and execute the request
     *
     * @param  string  $path  The path to merge
     * @param  string[]  $queryParams  The query parameters
     */
    protected function get(string $path, array $queryParams = []): ?array
    {
        $this->url = $this->setUrl($path, $queryParams);

        return $this->execute();
    }

    /**
     * Merge base URL with the path
     *
     * @param  string  $path  The path to merge
     * @param  string[]  $queryParams  The query parameters
     */
    protected function setUrl(string $path, array $queryParams = []): string
    {
        $this->url = TmdbUrl::API_V3_URL.TmdbUrl::fixUrl($path).'?'.http_build_query($queryParams);

        return $this->url;
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
     */
    protected function execute(): ?array
    {
        $client = new \GuzzleHttp\Client;

        $response = $client->request('GET', $this->url, [
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
                'accept' => 'application/json',
            ],
            'http_errors' => false,
        ]);

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $this->isSuccess = true;
        $this->body = json_decode($response->getBody()->getContents(), true);

        return $this->body;
    }
}
