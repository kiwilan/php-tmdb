<?php

namespace Kiwilan\Tmdb\Models;

class Credits
{
    protected ?int $id;

    /**
     * @var Credits\Cast[]
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
                $this->cast[] = new Credits\Cast($castData);
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
     * Get the cast and guest stars.
     *
     * @param  int|null  $limit  The maximum number of cast members to return.
     * @return Credits\Cast[]|null
     */
    public function getCast(?int $limit = null): ?array
    {
        if ($limit !== null) {
            return array_slice($this->cast, 0, $limit);
        }

        return $this->cast;
    }

    /**
     * Get the crew.
     *
     * @param  int|null  $limit  The maximum number of crew members to return.
     * @return Credits\Crew[]|null
     */
    public function getCrew(?int $limit = null): ?array
    {
        if ($limit !== null) {
            return array_slice($this->crew, 0, $limit);
        }

        return $this->crew;
    }

    /**
     * Get the directors.
     *
     * @return Credits\Crew[]|null
     */
    public function getCreators(): ?array
    {
        $creators = [];
        if (isset($this->crew)) {
            foreach ($this->crew as $crew) {
                if ($crew->getJob() === 'Creator' || $crew->getJob() === 'Director') {
                    $creators[] = $crew;
                }
            }
        }

        return $creators;
    }
}
