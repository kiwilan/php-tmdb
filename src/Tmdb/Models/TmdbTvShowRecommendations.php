<?php

namespace Kiwilan\Tmdb\Models;

class TmdbTvShowRecommendations
{
    public ?int $page = null;

    /** @var TmdbSearchTvShowResult[] */
    public ?array $results = null;

    public ?int $total_pages = null;

    public ?int $total_results = null;

    public function __construct(array $data)
    {
        $this->page = $data['page'] ?? null;
        $this->results = array_map(fn ($result) => new TmdbSearchTvShowResult($result), $data['results'] ?? []);
        $this->total_pages = $data['total_pages'] ?? null;
        $this->total_results = $data['total_results'] ?? null;
    }
}
