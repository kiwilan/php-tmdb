<?php

namespace Kiwilan\Tmdb\Results;

class TvSerieResults extends Results
{
    public function __construct(?array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? [], \Kiwilan\Tmdb\Models\TmdbTvSeries::class, false);
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\TmdbTvSeries
    {
        return $this->getFirst();
    }

    public function getLastResult(): ?\Kiwilan\Tmdb\Models\TmdbTvSeries
    {
        return $this->getLast();
    }

    /**
     * @return \Kiwilan\Tmdb\Models\TmdbTvSeries[]
     */
    public function filter(\Closure $closure): array
    {
        return $this->filterResults($closure);
    }

    public function find(\Closure $closure): ?\Kiwilan\Tmdb\Models\TmdbTvSeries
    {
        return $this->findResults($closure);
    }

    /**
     * @return \Kiwilan\Tmdb\Models\TmdbTvSeries[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
