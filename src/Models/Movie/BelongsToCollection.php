<?php

namespace Kiwilan\Tmdb\Models\Movie;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits;

/**
 * A collection of movies.
 */
class BelongsToCollection extends TmdbModel
{
    use Traits\TmdbHasBackdrop;
    use Traits\TmdbHasId;
    use Traits\TmdbHasPoster;
    use Traits\TmdbHasTmdbUrl;

    protected ?string $name = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->setPosterPath($data);
        $this->setBackdropPath($data);
        $this->name = $this->toString($data, 'name');
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
