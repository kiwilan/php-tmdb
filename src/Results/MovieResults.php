<?php

namespace Kiwilan\Tmdb\Results;

class MovieResults extends Results
{
    /** @var \Kiwilan\Tmdb\Models\Movie[] */
    protected array $results = [];

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? null, \Kiwilan\Tmdb\Models\Movie::class);
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
