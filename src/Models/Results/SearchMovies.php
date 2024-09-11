<?php

namespace Kiwilan\Tmdb\Models\Results;

class SearchMovies extends SearchResponse
{
    /** @var \Kiwilan\Tmdb\Models\Movie[] */
    protected array $results = [];

    public function __construct(array $data)
    {
        $this->page = $data['page'] ?? 1;
        $results = $data['results'] ?? [];
        foreach ($results as $result) {
            $this->results[] = new \Kiwilan\Tmdb\Models\Movie($result);
        }
        $this->total_pages = $data['total_pages'] ?? 1;
        $this->total_results = $data['total_results'] ?? 0;
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\Movie
    {
        return $this->results[0] ?? null;
    }

    /**
     * Get the search results
     *
     * @return \Kiwilan\Tmdb\Models\Movie[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
