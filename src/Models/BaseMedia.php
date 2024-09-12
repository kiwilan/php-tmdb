<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Traits\HasBackdrop;
use Kiwilan\Tmdb\Traits\HasId;
use Kiwilan\Tmdb\Traits\HasPoster;

abstract class BaseMedia extends TmdbModel
{
    use HasBackdrop;
    use HasId;
    use HasPoster;

    protected bool $adult = false;

    /** @var int[]|null */
    protected ?array $genre_ids = null;

    protected ?string $original_language = null;

    protected ?string $overview = null;

    protected ?float $popularity = null;

    protected ?float $vote_average = null;

    protected ?int $vote_count = null;

    /** @var string[]|null */
    protected ?array $origin_country = null;

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
        $this->popularity = $this->toFloat($data, 'popularity');
        $this->vote_average = $this->toFloat($data, 'vote_average');
        $this->vote_count = $this->toInt($data, 'vote_count');
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

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    public function getVoteCount(): ?int
    {
        return $this->vote_count;
    }
}
