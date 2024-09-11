<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits\HasId;
use Kiwilan\Tmdb\Traits\HasLogo;

class Network extends TmdbModel
{
    use HasId;
    use HasLogo;

    protected ?string $name = null;

    protected ?string $origin_country = null;

    public function __construct(array $data)
    {
        $this->setId($data);
        $this->setLogoPath($data);
        $this->name = $this->toString($data, 'name');
        $this->origin_country = $this->toString($data, 'origin_country');
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOriginCountry(): ?string
    {
        return $this->origin_country;
    }
}
