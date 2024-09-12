<?php

namespace Kiwilan\Tmdb\Models\Movie;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits\HasBackdrop;
use Kiwilan\Tmdb\Traits\HasId;
use Kiwilan\Tmdb\Traits\HasPoster;

class BelongsToCollection extends TmdbModel
{
    use HasBackdrop;
    use HasId;
    use HasPoster;

    protected ?string $name = null;

    protected ?string $backdrop_path = null;

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
