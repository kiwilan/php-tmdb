<?php

namespace Kiwilan\Tmdb\Models;

use Kiwilan\Tmdb\Models\Credits\TmdbCreditMedia;
use Kiwilan\Tmdb\Models\Credits\TmdbPerson;

/**
 * A credit for a person in a movie or TV series.
 */
class TmdbCredit extends TmdbModel
{
    protected ?string $credit_type = null;

    protected ?string $department = null;

    protected ?string $job = null;

    protected ?TmdbCreditMedia $media = null;

    protected ?string $media_type = null;

    protected ?string $id = null;

    protected ?TmdbPerson $person = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->credit_type = $this->toString('credit_type');
        $this->department = $this->toString('department');
        $this->job = $this->toString('job');
        $this->media_type = $this->toString('media_type');
        $this->id = $this->toString('id');
        $this->media = $this->toModel('media', TmdbCreditMedia::class);
        $this->person = $this->toModel('person', TmdbPerson::class);
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

    public function getMedia(): ?TmdbCreditMedia
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

    public function getPerson(): ?TmdbPerson
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
