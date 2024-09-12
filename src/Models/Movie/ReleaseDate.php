<?php

namespace Kiwilan\Tmdb\Models\Movie;

use Kiwilan\Tmdb\Models\TmdbModel;

class ReleaseDate extends TmdbModel
{
    protected ?string $iso_3166_1 = null;

    /** @var ReleaseDateItem[] */
    protected ?array $release_dates = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->iso_3166_1 = $this->toString($data, 'iso_3166_1');
        $this->release_dates = $this->validateData($data, 'release_dates', fn (array $values) => $this->loopOn($values, ReleaseDateItem::class));
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
