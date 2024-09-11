<?php

namespace Kiwilan\Tmdb\Models\Credits;

abstract class People
{
    protected bool $adult = false;

    protected ?int $gender = null;

    protected ?int $id = null;

    protected ?string $known_for_department = null;

    protected ?string $name = null;

    protected ?string $original_name = null;

    protected ?float $popularity = null;

    protected ?string $profile_path = null;

    protected ?string $credit_id = null;

    public function __construct(array $data)
    {
        $this->adult = $data['adult'] ? boolval($data['adult']) : false;
        $this->gender = $data['gender'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->known_for_department = $data['known_for_department'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->original_name = $data['original_name'] ?? null;
        $this->popularity = $data['popularity'] ?? null;
        $this->profile_path = $data['profile_path'] ?? null;
        $this->credit_id = $data['credit_id'] ?? null;
    }

    public function isAdult(): bool
    {
        return $this->adult;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function getId(): ?int
    {
        return $this->id;
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
