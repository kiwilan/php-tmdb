<?php

namespace Kiwilan\Tmdb\Results;

class TvSerieResults extends Results
{
    /** @var \Kiwilan\Tmdb\Models\TvSeries[] */
    protected array $results = [];

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? null, \Kiwilan\Tmdb\Models\TvSeries::class);
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
