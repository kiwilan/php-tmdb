<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Traits;

abstract class BaseMedia extends TmdbModel
{
    use Traits\TmdbHasBackdrop;
    use Traits\TmdbHasId;
    use Traits\TmdbHasPoster;
    use Traits\TmdbHasVotes;

    protected bool $adult = false;

    /** @var int[]|null */
    protected ?array $genre_ids = null;

    protected ?string $overview = null;

    protected ?string $original_language = null;

    /** @var string[]|null */
    protected ?array $origin_country = null;

    protected ?float $popularity = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->setBackdropPath($data);
        $this->setPosterPath($data);

        $this->adult = $this->toBool($data, 'adult');
        $this->genre_ids = $this->toArray($data, 'genre_ids');
        $this->original_language = $this->toString($data, 'original_language');
        $this->overview = $this->toString($data, 'overview');
        $this->setVotes($data);
        $this->popularity = $this->toFloat($data, 'popularity');
    }

    public function isAdult(): bool
    {
        return $this->adult;
    }

    /**
     * @return int[]|null
     */
    public function getGenreIds(): ?array
    {
        return $this->genre_ids;
    }

    public function getOriginalLanguage(): ?string
    {
        return $this->original_language;
    }

    /**
     * @return string[]|null
     */
    public function getOriginCountry(): ?array
    {
        return $this->origin_country;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }
}
