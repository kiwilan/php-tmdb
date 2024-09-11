<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Models\Credits\CreditMedia;
use Kiwilan\Tmdb\Models\Credits\Person;

class Credit extends TmdbModel
{
    protected ?string $credit_type = null;

    protected ?string $department = null;

    protected ?string $job = null;

    protected ?CreditMedia $media = null;

    protected ?string $media_type = null;

    protected ?string $id = null;

    protected ?Person $person = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->credit_type = $this->toString($data, 'credit_type');
        $this->department = $this->toString($data, 'department');
        $this->job = $this->toString($data, 'job');

        if (isset($data['media'])) {
            $this->media = new CreditMedia($data['media']);
        }

        $this->media_type = $this->toString($data, 'media_type');
        $this->id = $this->toString($data, 'id');

        if (isset($data['person'])) {
            $this->person = new Person($data['person']);
        }
    }

    public function getCreditType(): ?string
    {
        return $this->credit_type;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function getMedia(): ?CreditMedia
    {
        return $this->media;
    }

    public function getMediaType(): ?string
    {
        return $this->media_type;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function isCast(): bool
    {
        return $this->credit_type === 'cast';
    }

    public function isCrew(): bool
    {
        return $this->credit_type === 'crew';
    }
}
