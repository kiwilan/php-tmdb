<?php

namespace Kiwilan\Tmdb\Results;

class CollectionResults extends Results
{
    /** @var \Kiwilan\Tmdb\Models\Collection[] */
    protected array $results = [];

    public function __construct(array $data)
    {
        parent::__construct($data);

        $results = $data['results'] ?? [];
        foreach ($results as $result) {
            $this->results[] = new \Kiwilan\Tmdb\Models\Collection($result);
        }
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\Collection
    {
        return $this->results[0] ?? null;
    }

    /**
     * Get the search results
     *
     * @return \Kiwilan\Tmdb\Models\Collection[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
