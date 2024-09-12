<?php

namespace Kiwilan\Tmdb\Results;

class PeopleResults extends Results
{
    /** @var \Kiwilan\Tmdb\Models\Credits\Person[] */
    protected array $results = [];

    public function __construct(array $data)
    {
        parent::__construct($data);

        $results = $data['results'] ?? [];
        foreach ($results as $result) {
            $this->results[] = new \Kiwilan\Tmdb\Models\Credits\Person($result);
        }
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\Credits\Person
    {
        return $this->results[0] ?? null;
    }

    /**
     * Get the search results
     *
     * @return \Kiwilan\Tmdb\Models\Credits\Person[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
