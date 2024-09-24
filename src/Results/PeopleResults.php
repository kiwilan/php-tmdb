<?php

namespace Kiwilan\Tmdb\Results;

class PeopleResults extends Results
{
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? [], \Kiwilan\Tmdb\Models\Credits\TmdbPerson::class, false);
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\Credits\TmdbPerson
    {
        return $this->getFirst();
    }

    public function getLastResult(): ?\Kiwilan\Tmdb\Models\Credits\TmdbPerson
    {
        return $this->getLast();
    }

    /**
     * @return \Kiwilan\Tmdb\Models\Credits\TmdbPerson[]
     */
    public function filter(\Closure $closure): array
    {
        return $this->filterResults($closure);
    }

    public function find(\Closure $closure): ?\Kiwilan\Tmdb\Models\Credits\TmdbPerson
    {
        return $this->findResults($closure);
    }

    /**
     * @return \Kiwilan\Tmdb\Models\Credits\TmdbPerson[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
