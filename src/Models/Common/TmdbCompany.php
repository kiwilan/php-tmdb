<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits;

/**
 * A company that produces movies.
 */
class TmdbCompany extends TmdbModel
{
    use Traits\TmdbId;
    use Traits\TmdbLogo;

    protected ?string $logo_path = null;

    protected ?string $name = null;

    protected ?string $origin_country = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->setId();
        $this->setLogoPath();
        $this->name = $this->toString('name');
        $this->origin_country = $this->toString('origin_country');
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
