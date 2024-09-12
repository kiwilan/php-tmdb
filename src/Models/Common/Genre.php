<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits\HasId;

class Genre extends TmdbModel
{
    use HasId;

    protected ?string $name = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->name = $this->toString($data, 'name');
    }

    /**
     * Get the genre name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
