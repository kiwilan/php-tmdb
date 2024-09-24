<?php

namespace Kiwilan\Tmdb\Results;

class MovieResults extends Results
{
    public function __construct(?array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? [], \Kiwilan\Tmdb\Models\TmdbMovie::class, false);
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\TmdbMovie
    {
        return $this->getFirst();
    }

    public function getLastResult(): ?\Kiwilan\Tmdb\Models\TmdbMovie
    {
        return $this->getLast();
    }

    /**
     * @return \Kiwilan\Tmdb\Models\TmdbMovie[]
     */
    public function filter(\Closure $closure): array
    {
        return $this->filterResults($closure);
    }

    public function find(\Closure $closure): ?\Kiwilan\Tmdb\Models\TmdbMovie
    {
        return $this->findResults($closure);
    }

    /**
     * @return \Kiwilan\Tmdb\Models\TmdbMovie[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
