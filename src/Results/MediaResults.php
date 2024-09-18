<?php

namespace Kiwilan\Tmdb\Results;

use Kiwilan\Tmdb\Enums\TmdbMediaType;

class MediaResults extends Results
{
    /** @var \Kiwilan\Tmdb\Models\TmdbMedia[] */
    protected array $results = [];

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? [], \Kiwilan\Tmdb\Models\TmdbMedia::class, false);
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\TmdbMedia
    {
        return $this->results[0] ?? null;
    }

    public function getFirstMovie(): ?\Kiwilan\Tmdb\Models\TmdbMovie
    {
        $movies = array_filter($this->results, fn ($result) => $result->getMediaType() === TmdbMediaType::MOVIE);
        $movie = reset($movies);

        return $movie ? $movie->getMovie() : null;
    }

    public function getFirstTvSeries(): ?\Kiwilan\Tmdb\Models\TmdbTvSeries
    {
        $tvSeries = array_filter($this->results, fn ($result) => $result->getMediaType() === TmdbMediaType::TV);
        $tvSerie = reset($tvSeries);

        return $tvSerie ? $tvSerie->getTvSeries() : null;
    }

    public function getFirstPerson(): ?\Kiwilan\Tmdb\Models\Credits\TmdbPerson
    {
        $persons = array_filter($this->results, fn ($result) => $result->getMediaType() === TmdbMediaType::PERSON);
        $person = reset($persons);

        return $person ? $person->getPerson() : null;
    }

    /**
     * Get the search results
     *
     * @return \Kiwilan\Tmdb\Models\TmdbMedia[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
