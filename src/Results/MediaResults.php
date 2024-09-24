<?php

namespace Kiwilan\Tmdb\Results;

use Kiwilan\Tmdb\Enums\TmdbMediaType;

class MediaResults extends Results
{
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? [], \Kiwilan\Tmdb\Models\TmdbMedia::class, false);
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\TmdbMedia
    {
        return $this->getFirst();
    }

    public function getLastResult(): ?\Kiwilan\Tmdb\Models\TmdbMedia
    {
        return $this->getLast();
    }

    /**
     * @return \Kiwilan\Tmdb\Models\TmdbMedia[]
     */
    public function filter(\Closure $closure): array
    {
        return $this->filterResults($closure);
    }

    public function find(\Closure $closure): ?\Kiwilan\Tmdb\Models\TmdbMedia
    {
        return $this->findResults($closure);
    }

    public function getFirstMovie(): ?\Kiwilan\Tmdb\Models\TmdbMovie
    {
        $movie = $this->getFirstMedia(TmdbMediaType::MOVIE);

        return $movie ? $movie->getMovie() : null;
    }

    public function getFirstTvSeries(): ?\Kiwilan\Tmdb\Models\TmdbTvSeries
    {
        $tvSerie = $this->getFirstMedia(TmdbMediaType::TV);

        return $tvSerie ? $tvSerie->getTvSeries() : null;
    }

    public function getFirstPerson(): ?\Kiwilan\Tmdb\Models\Credits\TmdbPerson
    {
        $person = $this->getFirstMedia(TmdbMediaType::PERSON);

        return $person ? $person->getPerson() : null;
    }

    /**
     * @return \Kiwilan\Tmdb\Models\TmdbMedia[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    private function getFirstMedia(TmdbMediaType $mediaType): ?\Kiwilan\Tmdb\Models\TmdbMedia
    {
        $media = array_filter($this->results, fn ($result) => $result->getMediaType() === $mediaType);
        $firstMedia = reset($media);

        return $firstMedia ?: null;
    }
}
