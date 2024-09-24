<?php

namespace Kiwilan\Tmdb\Models\Credits;

/**
 * A crew member in a movie or TV series.
 */
class TmdbCrew extends TmdbPerson
{
    protected ?string $department = null;

    protected ?string $job = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->department = $this->toString('department');
        $this->job = $this->toString('job');
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }
}
