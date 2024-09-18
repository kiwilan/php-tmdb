<?php

namespace Kiwilan\Tmdb\Results;

class TvSerieResults extends Results
{
    /** @var \Kiwilan\Tmdb\Models\TmdbTvSeries[] */
    protected array $results = [];

    public function __construct(?array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? [], \Kiwilan\Tmdb\Models\TmdbTvSeries::class, false);
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\TmdbTvSeries
    {
        return $this->results[0] ?? null;
    }

    /**
     * Get the search results
     *
     * @return \Kiwilan\Tmdb\Models\TmdbTvSeries[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
