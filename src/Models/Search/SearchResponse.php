<?php

namespace Kiwilan\Tmdb\Models\Search;

use Kiwilan\Tmdb\Models\TmdbModel;

abstract class SearchResponse extends TmdbModel
{
    protected int $page;

    protected int $total_pages;

    protected int $total_results;

    public function __construct(array $data)
    {
        $this->page = $this->toInt($data, 'page', 1);
        $this->total_pages = $this->toInt($data, 'total_pages', 1);
        $this->total_results = $this->toInt($data, 'total_results', 0);
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
