<?php

namespace Kiwilan\Tmdb\Models;

class TmdbSearchMovie
{
    public ?int $page = null;

    /**
     * @var TmdbSearchMovieResult[]|null
     */
    public ?array $results = null;

    public ?int $total_pages = null;

    public ?int $total_results = null;

    public function __construct(array $data)
    {
        $this->page = $data['page'] ?? null;
        $this->results = [];

        if (isset($data['results']) && is_array($data['results'])) {
            foreach ($data['results'] as $result) {
                $this->results[] = new TmdbSearchMovieResult($result);
            }
        }

        $this->total_pages = $data['total_pages'] ?? null;
        $this->total_results = $data['total_results'] ?? null;
    }
}
