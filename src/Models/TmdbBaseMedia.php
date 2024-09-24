<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Traits;

abstract class TmdbBaseMedia extends TmdbModel
{
    use Traits\TmdbBackdrop;
    use Traits\TmdbId;
    use Traits\TmdbPoster;
    use Traits\TmdbVotes;

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

        parent::__construct($data);

        $this->setId();
        $this->setBackdropPath();
        $this->setPosterPath();

        $this->adult = $this->toBool('adult');
        $this->genre_ids = $this->toArray('genre_ids');
        $this->original_language = $this->toString('original_language');
        $this->overview = $this->toString('overview');
        $this->setVotes();
        $this->popularity = $this->toFloat('popularity');
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
