<?php

namespace Kiwilan\Tmdb;

use GuzzleHttp\Client;

class TmdbResponse
{
    protected function __construct(
        protected mixed $data,
    ) {}

    public static function make(mixed $data): self
    {
        return new self(data: $data);
    }

    public static function search(mixed $results): mixed
    {
        $self = new self($results);
        $results = $self->get('results');

        if (! $results) {
            return null;
        }

        return $results[0] ?? null;
    }

    public static function imageUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $urlPrefix = 'https://image.tmdb.org/t/p/original';

        return "{$urlPrefix}{$path}";
    }

    public static function image(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $url = self::imageUrl($path);
        $client = new Client;
        $response = $client->get($url);

        return $response->getBody()->getContents();
    }

    public function get(string $key): mixed
    {
        return $this->data[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }

    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * Get a deep value from the data.
     *
     * @param  string[]|int[]  $keys
     */
    public function deep(array $keys): mixed
    {
        $data = $this->data;
        foreach ($keys as $key) {
            $data = $data[$key] ?? null;
        }

        return $data;
    }
}
