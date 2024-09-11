<?php

namespace Kiwilan\Tmdb\Models\Movie;

use DateTime;

class ReleaseDateItem
{
    protected ?string $certification = null;

    /** @var string[] */
    protected ?array $descriptors = null;

    protected ?string $iso_639_1 = null;

    protected ?string $note = null;

    protected ?DateTime $release_date = null;

    protected ?int $type = null;

    public function __construct(array $data)
    {
        $this->certification = $data['certification'] ?? null;
        $this->descriptors = $data['descriptors'] ?? null;
        $this->iso_639_1 = $data['iso_639_1'] ?? null;
        $this->note = $data['note'] ?? null;
        $release_date = $data['release_date'] ?? null;
        if ($release_date) {
            $this->release_date = new DateTime($release_date);
        }
        $this->type = $data['type'] ?? null;
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
    public function getIso6391(): ?string
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
