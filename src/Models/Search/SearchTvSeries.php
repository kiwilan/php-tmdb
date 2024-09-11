<?php

namespace Kiwilan\Tmdb\Models\Search;

class SearchTvSeries extends SearchResponse
{
    /** @var \Kiwilan\Tmdb\Models\TvSeries[] */
    protected array $results = [];

    public function __construct(array $data)
    {
        parent::__construct($data);
        $results = $data['results'] ?? [];
        foreach ($results as $result) {
            $this->results[] = new \Kiwilan\Tmdb\Models\TvSeries($result);
        }
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\TvSeries
    {
        return $this->results[0] ?? null;
    }

    /**
     * Get the search results
     *
     * @return \Kiwilan\Tmdb\Models\TvSeries[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
