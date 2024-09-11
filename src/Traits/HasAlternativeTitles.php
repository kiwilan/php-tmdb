<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Models\Common\AlternativeTitle;

trait HasAlternativeTitles
{
    /** @var AlternativeTitle[]|null */
    protected ?array $alternative_titles = null;

    protected function setAlternativeTitles(array $data): void
    {
        if (isset($data['alternative_titles'])) {
            $alternative_titles = $data['alternative_titles']['results'] ?? $data['alternative_titles']['titles'] ?? [];
            if (empty($alternative_titles)) {
                return;
            }

            foreach ($alternative_titles as $alternative_title) {
                $this->alternative_titles[] = new AlternativeTitle($alternative_title);
            }
        }
    }

    /**
     * Get the alternative titles.
     *
     * @return AlternativeTitle[]|null
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
    public function getAlternativeTitle(string $iso_3166_1): ?AlternativeTitle
    {
        if (! $this->alternative_titles) {
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
