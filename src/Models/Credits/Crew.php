<?php

namespace Kiwilan\Tmdb\Models\Credits;

class Crew
{
    protected ?string $job;

    protected ?string $department;

    protected ?string $credit_id;

    protected ?bool $adult;

    protected ?int $gender;

    protected ?int $id;

    protected ?string $known_for_department;

    protected ?string $name;

    protected ?string $original_name;

    protected ?float $popularity;

    protected ?string $profile_path;

    protected ?int $cast_id;

    protected ?string $character;

    protected ?int $order;

    public function __construct(array $data)
    {
        $this->job = $data['job'] ?? null;
        $this->department = $data['department'] ?? null;
        $this->credit_id = $data['credit_id'] ?? null;
        $this->adult = $data['adult'] ?? null;
        $this->gender = $data['gender'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->known_for_department = $data['known_for_department'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->original_name = $data['original_name'] ?? null;
        $this->popularity = $data['popularity'] ?? null;
        $this->profile_path = $data['profile_path'] ?? null;
        $this->cast_id = $data['cast_id'] ?? null;
        $this->character = $data['character'] ?? null;
        $this->order = $data['order'] ?? null;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function getCreditId(): ?string
    {
        return $this->credit_id;
    }

    public function isAdult(): ?bool
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

    public function getCastId(): ?int
    {
        return $this->cast_id;
    }

    public function getCharacter(): ?string
    {
        return $this->character;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }
}
