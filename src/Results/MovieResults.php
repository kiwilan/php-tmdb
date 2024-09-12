<?php

namespace Kiwilan\Tmdb\Results;

class MovieResults extends Results
{
    /** @var \Kiwilan\Tmdb\Models\Movie[] */
    protected array $results = [];

    public function __construct(array $data)
    {
        parent::__construct($data);

        $results = $data['results'] ?? [];
        foreach ($results as $result) {
            $this->results[] = new \Kiwilan\Tmdb\Models\Movie($result);
        }
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
