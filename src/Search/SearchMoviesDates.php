<?php

namespace Kiwilan\Tmdb\Search;

use Kiwilan\Tmdb\Search\Common\SearchDates;

class SearchMoviesDates extends SearchMovies
{
    protected ?SearchDates $dates = null;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->dates = new SearchDates($data['dates'] ?? []);

        $results = $data['results'] ?? [];
        foreach ($results as $result) {
            $this->results[] = new \Kiwilan\Tmdb\Models\Movie($result);
        }
    }

    public function getDates(): ?SearchDates
    {
        return $this->dates;
    }
}
