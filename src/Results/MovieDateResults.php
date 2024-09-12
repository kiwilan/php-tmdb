<?php

namespace Kiwilan\Tmdb\Results;

use Kiwilan\Tmdb\Results\Common\ResultsDates;

class MovieDateResults extends MovieResults
{
    protected ?ResultsDates $dates = null;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->dates = new ResultsDates($data['dates'] ?? []);

        $results = $data['results'] ?? [];
        foreach ($results as $result) {
            $this->results[] = new \Kiwilan\Tmdb\Models\Movie($result);
        }
    }

    public function getDates(): ?ResultsDates
    {
        return $this->dates;
    }
}
