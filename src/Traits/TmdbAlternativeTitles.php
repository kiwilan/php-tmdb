<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Models\Common\TmdbAlternativeTitle;

trait TmdbAlternativeTitles
{
    /** @var TmdbAlternativeTitle[]|null */
    protected ?array $alternative_titles = null;

    protected function setAlternativeTitles(): void
    {
        $titles = $this->raw_data['alternative_titles'] ?? null;
        if (isset($titles)) {
            $alternative_titles = $titles['results'] ?? $titles['titles'] ?? null;
            if (empty($alternative_titles)) {
                return;
            }

            foreach ($alternative_titles as $alternative_title) {
                $this->alternative_titles[] = new TmdbAlternativeTitle($alternative_title);
            }
        }
    }

    /**
     * Get the alternative titles.
     *
     * @return TmdbAlternativeTitle[]|null
     */
    public function getAlternativeTitles(): ?array
    {
        return $this->alternative_titles;
    }

    /**
     * Get the alternative title by ISO 3166-1 code.
     *
     * - If not found, return null.
     * - If duplicate, return the first one.
     */
    public function getAlternativeTitle(string $iso_3166_1): ?TmdbAlternativeTitle
    {
        if (! $this->alternative_titles || empty($this->alternative_titles)) {
            return null;
        }

        foreach ($this->alternative_titles as $alternative_title) {
            if ($alternative_title->getIso31661() === $iso_3166_1) {
                return $alternative_title;
            }
        }

        return null;
    }
}
