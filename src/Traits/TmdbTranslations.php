<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Models\Translations\TmdbTranslation;

trait TmdbTranslations
{
    /** @var array<string, TmdbTranslation>|null */
    protected ?array $translations = null;

    /**
     * Get the translations, if available.
     *
     * @return null|array<string, TmdbTranslation>
     */
    public function getTranslations(): ?array
    {
        return $this->translations;
    }

    /**
     * Get the translation for a specific language.
     */
    public function getTranslation(string $language): ?TmdbTranslation
    {
        if (! $this->translations) {
            return null;
        }

        return $this->translations[$language] ?? null;
    }
}
