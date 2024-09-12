<?php

namespace Kiwilan\Tmdb\Models\Credits;

class Crew extends Person
{
    protected ?string $department = null;

    protected ?string $job = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->department = $this->toString($data, 'department');
        $this->job = $this->toString($data, 'job');
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
