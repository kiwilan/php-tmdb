<?php

namespace Kiwilan\Tmdb\Results;

class MovieResults extends Results
{
    /** @var \Kiwilan\Tmdb\Models\TmdbMovie[] */
    protected ?array $results = [];

    public function __construct(?array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? [], \Kiwilan\Tmdb\Models\TmdbMovie::class, false);
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\TmdbMovie
    {
        return $this->results[0] ?? null;
    }

    /**
     * Get the search results
     *
     * @return \Kiwilan\Tmdb\Models\TmdbMovie[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
