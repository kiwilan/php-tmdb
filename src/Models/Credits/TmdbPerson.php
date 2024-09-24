<?php

namespace Kiwilan\Tmdb\Models\Credits;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits;

/**
 * A person who contributed to a movie or TV series.
 */
class TmdbPerson extends TmdbModel
{
    use Traits\TmdbId;
    use Traits\TmdbProfile;
    use Traits\TmdbTmdbUrl;

    protected bool $adult = false;

    protected ?int $gender = null;

    protected ?string $known_for_department = null;

    protected ?string $name = null;

    protected ?string $original_name = null;

    protected ?float $popularity = null;

    protected ?string $credit_id = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->setId();
        $this->setProfilePath();

        $this->adult = $this->toBool('adult');
        $this->gender = $this->toInt('gender');
        $this->known_for_department = $this->toString('known_for_department');
        $this->name = $this->toString('name');
        $this->original_name = $this->toString('original_name');
        $this->popularity = $this->toFloat('popularity');
        $this->credit_id = $this->toString('credit_id');
    }

    public function isAdult(): bool
    {
        return $this->adult;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function getKnownForDepartment(): ?string
    {
        return $this->known_for_department;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOriginalName(): ?string
    {
        return $this->original_name;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    public function getCreditId(): ?string
    {
        return $this->credit_id;
    }
}
