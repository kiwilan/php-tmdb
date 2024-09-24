<?php

namespace Kiwilan\Tmdb\Models\Translations;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits\TmdbId;

class TmdbTranslations extends TmdbModel
{
    use TmdbId;

    /** @var null|TmdbTranslation[] */
    protected ?array $translations = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->setId();
        $this->translations = $this->toClassArray('translations', TmdbTranslation::class);
    }

    /**
     * @return null|TmdbTranslation[]
     */
    public function getTranslations(): ?array
    {
        return $this->translations;
    }
}
