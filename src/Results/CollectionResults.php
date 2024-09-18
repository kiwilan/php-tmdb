<?php

namespace Kiwilan\Tmdb\Results;

class CollectionResults extends Results
{
    /** @var \Kiwilan\Tmdb\Models\TmdbCollection[] */
    protected array $results = [];

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? [], \Kiwilan\Tmdb\Models\TmdbCollection::class, false);
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\TmdbCollection
    {
        return $this->results[0] ?? null;
    }

    /**
     * Get the search results
     *
     * @return \Kiwilan\Tmdb\Models\TmdbCollection[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
