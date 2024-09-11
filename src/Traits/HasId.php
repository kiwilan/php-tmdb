<?php

namespace Kiwilan\Tmdb\Traits;

trait HasId
{
    protected ?int $id = null;

    protected function setId(?array $data, string $key = 'id'): void
    {
        $this->id = $data[$key] ?? null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
