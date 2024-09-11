<?php

namespace Kiwilan\Tmdb\Models;

class Genre
{
    protected ?int $id;

    protected ?string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
    }

    /**
     * Get the genre ID.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the genre name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
