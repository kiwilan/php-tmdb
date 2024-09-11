<?php

namespace Kiwilan\Tmdb\Models;

class Credits
{
    protected ?int $id;

    /**
     * @var Credits\Crew[]
     */
    protected ?array $cast;

    /**
     * @var Credits\Crew[]
     */
    protected ?array $crew;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        if (isset($data['cast']) && is_array($data['cast'])) {
            $this->cast = [];
            foreach ($data['cast'] as $castData) {
                $this->cast[] = new Credits\Crew($castData);
            }
        }
        if (isset($data['crew']) && is_array($data['crew'])) {
            $this->crew = [];
            foreach ($data['crew'] as $crewData) {
                $this->crew[] = new Credits\Crew($crewData);
            }
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the cast.
     *
     * @return Credits\Crew[]|null
     */
    public function getCast(): ?array
    {
        return $this->cast;
    }

    /**
     * Get the crew.
     *
     * @return Credits\Crew[]|null
     */
    public function getCrew(): ?array
    {
        return $this->crew;
    }
}
