<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Traits;

/**
 * A collection of movies.
 */
class TmdbCollection extends TmdbModel
{
    use Traits\TmdbBackdrop;
    use Traits\TmdbId;
    use Traits\TmdbPoster;
    use Traits\TmdbTmdbUrl;

    protected ?string $name = null;

    protected ?string $overview = null;

    protected ?string $original_language = null;

    protected ?string $original_name = null;

    protected bool $adult = false;

    /** @var TmdbMovie[]|null */
    protected ?array $parts = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->setId();
        $this->setPosterPath();
        $this->setBackdropPath();

        $this->name = $this->toString('name');
        $this->overview = $this->toString('overview');
        $this->original_language = $this->toString('original_language');
        $this->original_name = $this->toString('original_name');
        $this->adult = $this->toBool('adult');

        $this->parts = $this->validateData('parts', fn (array $values) => $this->loopOn($values, TmdbMovie::class));
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getOriginalLanguage(): ?string
    {
        return $this->original_language;
    }

    public function getOriginalName(): ?string
    {
        return $this->original_name;
    }

    public function isAdult(): bool
    {
        return $this->adult;
    }

    /**
     * @return TmdbMovie[]
     */
    public function getParts(): array
    {
        return $this->parts;
    }
}
