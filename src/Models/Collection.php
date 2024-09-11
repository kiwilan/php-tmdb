<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Traits\HasBackdrop;
use Kiwilan\Tmdb\Traits\HasId;
use Kiwilan\Tmdb\Traits\HasPoster;

class Collection extends TmdbModel
{
    use HasBackdrop;
    use HasId;
    use HasPoster;

    protected ?string $name = null;

    protected ?string $overview = null;

    /** @var Movie[]|null */
    protected ?array $parts = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->name = $this->toString($data, 'name');
        $this->overview = $this->toString($data, 'overview');
        $this->setPosterPath($data);
        $this->setBackdropPath($data);

        $this->validateData($data, 'parts', function (array $values) {
            $this->parts = $this->loopOn($values, Movie::class);
        });
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * @return Movie[]
     */
    public function getParts(): array
    {
        return $this->parts;
    }
}
