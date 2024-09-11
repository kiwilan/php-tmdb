<?php

namespace Kiwilan\Tmdb\Models;

class TmdbCreatedBy
{
    public ?int $id;

    public ?string $credit_id;

    public ?string $name;

    public ?int $gender;

    public ?string $profile_path;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->credit_id = $data['credit_id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->gender = $data['gender'] ?? null;
        $this->profile_path = $data['profile_path'] ?? null;
    }
}
