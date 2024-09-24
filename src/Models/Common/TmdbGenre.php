<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits;

/**
 * A genre of a movie or TV series.
 */
class TmdbGenre extends TmdbModel
{
    use Traits\TmdbId;

    protected ?string $name = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->setId();
        $this->name = $this->toString('name');
    }

    /**
     * Get the genre name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
