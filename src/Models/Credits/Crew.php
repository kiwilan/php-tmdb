<?php

namespace Kiwilan\Tmdb\Models\Credits;

class Crew extends People
{
    protected ?string $department = null;

    protected ?string $job = null;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->department = $data['department'] ?? null;
        $this->job = $data['job'] ?? null;
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
