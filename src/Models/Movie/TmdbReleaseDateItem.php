<?php

namespace Kiwilan\Tmdb\Models\Movie;

use DateTime;
use Kiwilan\Tmdb\Models\TmdbModel;

/**
 * A release date item for a movie.
 */
class TmdbReleaseDateItem extends TmdbModel
{
    protected ?string $certification = null;

    /** @var string[] */
    protected ?array $descriptors = null;

    protected ?string $iso_639_1 = null;

    protected ?string $note = null;

    protected ?DateTime $release_date = null;

    protected ?int $type = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->certification = $this->toString('certification');
        $this->descriptors = $this->toArray('descriptors');
        $this->iso_639_1 = $this->toString('iso_639_1');
        $this->note = $this->toString('note');
        $this->release_date = $this->toDateTime('release_date');
        $this->type = $this->toInt('type');
    }

    /**
     * Get the certification, like `PG-13`.
     */
    public function getCertification(): ?string
    {
        return $this->certification;
    }

    /**
     * Get the descriptors.
     *
     * @return string[]
     */
    public function getDescriptors(): ?array
    {
        return $this->descriptors;
    }

    /**
     * Get the ISO 639-1, like `en`.
     */
    public function getIso639(): ?string
    {
        return $this->iso_639_1;
    }

    /**
     * Get the note.
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * Get the release date.
     */
    public function getReleaseDate(): ?DateTime
    {
        return $this->release_date;
    }

    /**
     * Get the type.
     */
    public function getType(): ?int
    {
        return $this->type;
    }
}
