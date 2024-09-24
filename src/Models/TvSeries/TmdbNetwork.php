<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits;

/**
 * A network that broadcasts TV series.
 */
class TmdbNetwork extends TmdbModel
{
    use Traits\TmdbId;
    use Traits\TmdbLogo;

    protected ?string $name = null;

    protected ?string $origin_country = null;

    protected ?string $headquarters = null;

    protected ?string $homepage = null;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->setId();
        $this->setLogoPath();

        $this->name = $this->toString('name');
        $this->origin_country = $this->toString('origin_country');
        $this->headquarters = $this->toString('headquarters');
        $this->homepage = $this->toString('homepage');
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOriginCountry(): ?string
    {
        return $this->origin_country;
    }

    public function getHeadquarters(): ?string
    {
        return $this->headquarters;
    }

    public function getHomepage(): ?string
    {
        return $this->homepage;
    }
}
