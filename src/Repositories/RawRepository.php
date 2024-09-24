<?php

namespace Kiwilan\Tmdb\Repositories;

/**
 * Raw repository, used to send raw requests to the API.
 *
 * @docs https://developer.themoviedb.org/reference/intro/getting-started
 */
class RawRepository extends Repository
{
    /**
     * Execute a request on the API, the API key will be associated with the request.
     *
     * @param  string  $url  The URL to send the request, like `/movie/now_playing`
     * @param  string[]  $params  The query parameters, like `['language' => 'en-US', 'page' => 1]`
     *
     * @docs https://developer.themoviedb.org/reference/intro/getting-started
     */
    public function url(string $url, ?array $params = null): ?RawRepository
    {
        if (! $params) {
            $params = [];
        }

        $this->get($url, $params);

        return $this->isSuccess ? $this : null;
    }
}
