<?php

namespace Kiwilan\Tmdb\Traits;

trait TmdbId
{
    protected ?int $id = null;

    protected function setId(string $key = 'id'): void
    {
        $this->id = $this->raw_data[$key] ?? null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
