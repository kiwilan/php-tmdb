<?php

namespace Kiwilan\Tmdb\Results;

class MediaResults extends Results
{
    /** @var \Kiwilan\Tmdb\Models\Media[] */
    protected array $results = [];

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->results = $this->loopOn($data['results'] ?? null, \Kiwilan\Tmdb\Models\Media::class);
    }

    public function getFirstResult(): ?\Kiwilan\Tmdb\Models\Media
    {
        return $this->results[0] ?? null;
    }

    /**
     * Get the search results
     *
     * @return \Kiwilan\Tmdb\Models\Media[]
     */
    public function getResults(): array
    {
        return $this->results;
    }
}
