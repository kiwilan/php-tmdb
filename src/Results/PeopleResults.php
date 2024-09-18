<?php

namespace Kiwilan\Tmdb\Results;

class PeopleResults extends Results
{
    /** @var \Kiwilan\Tmdb\Models\Credits\TmdbPerson[] */
    protected array $results = [];

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? [], \Kiwilan\Tmdb\Models\Credits\TmdbPerson::class, false);
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\Credits\TmdbPerson
    {
        return $this->results[0] ?? null;
    }

    /**
     * Get the search results
     *
     * @return \Kiwilan\Tmdb\Models\Credits\TmdbPerson[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
