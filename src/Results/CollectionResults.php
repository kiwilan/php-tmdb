<?php

namespace Kiwilan\Tmdb\Results;

class CollectionResults extends Results
{
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? [], \Kiwilan\Tmdb\Models\TmdbCollection::class, false);
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\TmdbCollection
    {
        return $this->getFirst();
    }

    public function getLastResult(): ?\Kiwilan\Tmdb\Models\TmdbCollection
    {
        return $this->getLast();
    }

    /**
     * @return \Kiwilan\Tmdb\Models\TmdbCollection[]
     */
    public function filter(\Closure $closure): array
    {
        return $this->filterResults($closure);
    }

    public function find(\Closure $closure): ?\Kiwilan\Tmdb\Models\TmdbCollection
    {
        return $this->findResults($closure);
    }

    /**
     * @return \Kiwilan\Tmdb\Models\TmdbCollection[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
