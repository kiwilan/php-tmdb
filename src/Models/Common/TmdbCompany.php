<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits;

/**
 * A company that produces movies.
 */
class TmdbCompany extends TmdbModel
{
    use Traits\TmdbHasId;
    use Traits\TmdbHasLogo;

    protected ?string $logo_path = null;

    protected ?string $name = null;

    protected ?string $origin_country = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->setId($data);
        $this->setLogoPath($data);
        $this->name = $this->toString($data, 'name');
        $this->origin_country = $this->toString($data, 'origin_country');
    }

    public function getId(): ?int
    {
        return $this->id;
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