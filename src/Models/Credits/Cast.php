<?php

namespace Kiwilan\Tmdb\Models\Credits;

class Cast extends People
{
    protected ?int $cast_id = null;

    protected ?string $character = null;

    protected ?int $order = null;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->cast_id = $data['cast_id'] ?? null;
        $this->character = $data['character'] ?? null;
        $this->order = $data['order'] ?? null;
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
