<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Models\Credits\TmdbCast;
use Kiwilan\Tmdb\Models\Credits\TmdbCrew;
use Kiwilan\Tmdb\Traits;

/**
 * Credits for a movie or TV series, including cast and crew.
 */
class TmdbCredits extends TmdbModel
{
    use Traits\TmdbHasId;

    /**
     * @var TmdbCast[]
     */
    protected ?array $cast = null;

    /**
     * @var TmdbCrew[]
     */
    protected ?array $crew = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->cast = $this->validateData($data, 'cast', fn (array $values) => $this->loopOn($values, TmdbCast::class));
        $this->crew = $this->validateData($data, 'crew', fn (array $values) => $this->loopOn($values, TmdbCrew::class));
    }

    /**
     * Get the cast and guest stars.
     *
     * @param  int|null  $limit  The maximum number of cast members to return.
     * @return Credits\TmdbCast[]|null
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
     * @return Credits\TmdbCrew[]|null
     */
    public function getCrew(?int $limit = null): ?array
    {
        if ($limit !== null) {
            return array_slice($this->crew, 0, $limit);
        }

        return $this->crew;
    }
}
