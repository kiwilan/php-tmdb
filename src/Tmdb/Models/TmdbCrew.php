<?php

namespace Kiwilan\Tmdb\Models;

class TmdbCrew
{
    public ?string $job;

    public ?string $department;

    public ?string $credit_id;

    public ?bool $adult;

    public ?int $gender;

    public ?int $id;

    public ?string $known_for_department;

    public ?string $name;

    public ?string $original_name;

    public ?float $popularity;

    public ?string $profile_path;

    public ?int $cast_id;

    public ?string $character;

    public ?int $order;

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
}
