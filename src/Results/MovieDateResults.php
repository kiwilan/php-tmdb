<?php

namespace Kiwilan\Tmdb\Results;

use Kiwilan\Tmdb\Results\Common\ResultsDates;

class MovieDateResults extends MovieResults
{
    protected ?ResultsDates $dates = null;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->dates = new ResultsDates($data['dates'] ?? null);
        $this->results = $this->loopOn($data['results'] ?? [], \Kiwilan\Tmdb\Models\TmdbMovie::class, false);
    }

    public function getDates(): ?ResultsDates
    {
        return $this->dates;
    }
}
