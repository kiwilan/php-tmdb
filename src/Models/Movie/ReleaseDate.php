<?php

namespace Kiwilan\Tmdb\Models\Movie;

class ReleaseDate
{
    protected ?string $iso_3166_1 = null;

    /** @var ReleaseDateItem[] */
    protected ?array $release_dates = null;

    public function __construct(array $data)
    {
        $this->iso_3166_1 = $data['iso_3166_1'] ?? null;
        $this->release_dates = [];
        if (isset($data['release_dates']) && is_array($data['release_dates'])) {
            foreach ($data['release_dates'] as $movieData) {
                $this->release_dates[] = new ReleaseDateItem($movieData);
            }
        }
    }

    /**
     * Get the ISO 3166-1, like `FI`.
     */
    public function getIso31661(): ?string
    {
        return $this->iso_3166_1;
    }

    /**
     * Get the release dates.
     *
     * @return ReleaseDateItem[]
     */
    public function getReleaseDates(): ?array
    {
        return $this->release_dates;
    }

    public function getFirstReleaseDate(): ?ReleaseDateItem
    {
        return $this->release_dates[0] ?? null;
    }

    public function getSpecificReleaseDate(string $note): ?ReleaseDateItem
    {
        if (! $this->release_dates) {
            return null;
        }

        foreach ($this->release_dates as $release_date) {
            if ($release_date->getNote() === $note) {
                return $release_date;
            }
        }

        return null;
    }
}
