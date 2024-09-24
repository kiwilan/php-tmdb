<?php

namespace Kiwilan\Tmdb\Models\Credits;

/**
 * A cast member or guest star in a movie or TV series.
 */
class TmdbCast extends TmdbPerson
{
    protected ?int $cast_id = null;

    protected ?string $character = null;

    protected ?int $order = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->cast_id = $this->toInt('cast_id');
        $this->character = $this->toString('character');
        $this->order = $this->toInt('order', 0);
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
