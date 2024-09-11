<?php

namespace Kiwilan\Tmdb;

class TmdbSearch
{
    public function movie(string $apiKey, string $url, array $queryParams = []): array
    {
        $client = new \GuzzleHttp\Client;

        $url = $url.'?'.http_build_query($queryParams);
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => "Bearer {$apiKey}",
            ],
            'http_errors' => false,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
