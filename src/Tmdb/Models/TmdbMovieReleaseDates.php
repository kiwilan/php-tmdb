<?php

namespace Kiwilan\Tmdb\Models;

class TmdbMovieReleaseDates
{
    public ?int $id;

    /** @var TmdbMovieReleaseDate[] */
    public ?array $results = null;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->results = [];
        if (isset($data['results']) && is_array($data['results'])) {
            foreach ($data['results'] as $releaseDateData) {
                $this->results[] = new TmdbMovieReleaseDate($releaseDateData);
            }
        }
    }
}

class TmdbMovieReleaseDate
{
    public ?string $iso_3166_1 = null;

    /** @var TmdbMovieReleaseDateItem[] */
    public ?array $release_dates = null;

    public function __construct(array $data)
    {
        $this->iso_3166_1 = $data['iso_3166_1'] ?? null;
        $this->release_dates = [];
        if (isset($data['release_dates']) && is_array($data['release_dates'])) {
            foreach ($data['release_dates'] as $movieData) {
                $this->release_dates[] = new TmdbMovieReleaseDateItem($movieData);
            }
        }
    }
}

class TmdbMovieReleaseDateItem
{
    public ?string $certification = null;

    /** @var string[] */
    public ?array $descriptors = null;

    public ?string $iso_639_1 = null;

    public ?string $note = null;

    public ?string $release_date = null;

    public ?int $type = null;

    public function __construct(array $data)
    {
        $this->certification = $data['certification'] ?? null;
        $this->descriptors = $data['descriptors'] ?? null;
        $this->iso_639_1 = $data['iso_639_1'] ?? null;
        $this->note = $data['note'] ?? null;
        $this->release_date = $data['release_date'] ?? null;
        $this->type = $data['type'] ?? null;
    }
}
