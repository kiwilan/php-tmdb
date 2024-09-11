<?php

namespace Kiwilan\Tmdb\Models;

class Credits
{
    public ?int $id = null;

    /**
     * @var TmdbCrew[]
     */
    public ?array $cast = null;

    /**
     * @var TmdbCrew[]
     */
    public ?array $crew = null;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        if (isset($data['cast']) && is_array($data['cast'])) {
            $this->cast = [];
            foreach ($data['cast'] as $castData) {
                $this->cast[] = new TmdbCrew($castData);
            }
        }
        if (isset($data['crew']) && is_array($data['crew'])) {
            $this->crew = [];
            foreach ($data['crew'] as $crewData) {
                $this->crew[] = new TmdbCrew($crewData);
            }
        }
    }
}
