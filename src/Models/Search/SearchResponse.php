<?php

namespace Kiwilan\Tmdb\Models\Search;

class SearchResponse
{
    protected int $page;

    protected int $total_pages;

    protected int $total_results;

    public function __construct(array $data)
    {
        $this->page = $data['page'] ?? 1;
        $this->total_pages = $data['total_pages'] ?? 1;
        $this->total_results = $data['total_results'] ?? 0;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getTotalPages(): int
    {
        return $this->total_pages;
    }

    public function getTotalResults(): int
    {
        return $this->total_results;
    }
}
