<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Models\Credits\Cast;
use Kiwilan\Tmdb\Models\Credits\Crew;
use Kiwilan\Tmdb\Traits\HasId;

/**
 * Credits for a movie or TV series, including cast and crew.
 */
class Credits extends TmdbModel
{
    use HasId;

    /**
     * @var Cast[]
     */
    protected ?array $cast = null;

    /**
     * @var Crew[]
     */
    protected ?array $crew = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->cast = $this->validateData($data, 'cast', fn (array $values) => $this->loopOn($values, Cast::class));
        $this->crew = $this->validateData($data, 'crew', fn (array $values) => $this->loopOn($values, Crew::class));
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
}
