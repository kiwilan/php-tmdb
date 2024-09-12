<?php

namespace Kiwilan\Tmdb\Models\Credits;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits\HasId;

class Person extends TmdbModel
{
    use HasId;

    protected bool $adult = false;

    protected ?int $gender = null;

    protected ?string $known_for_department = null;

    protected ?string $name = null;

    protected ?string $original_name = null;

    protected ?float $popularity = null;

    protected ?string $profile_path = null;

    protected ?string $credit_id = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->adult = $this->toBool($data, 'adult');
        $this->gender = $this->toInt($data, 'gender');
        $this->setId($data);
        $this->known_for_department = $this->toString($data, 'known_for_department');
        $this->name = $this->toString($data, 'name');
        $this->original_name = $this->toString($data, 'original_name');
        $this->popularity = $this->toFloat($data, 'popularity');
        $this->profile_path = $this->toString($data, 'profile_path');
        $this->credit_id = $this->toString($data, 'credit_id');
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

    public function getProfilePath(): ?string
    {
        return $this->profile_path;
    }

    public function getCreditId(): ?string
    {
        return $this->credit_id;
    }
}