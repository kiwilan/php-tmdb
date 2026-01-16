<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits\TmdbIsoCode;

/**
 * Language information.
 */
class TmdbLanguage extends TmdbModel
{
    use TmdbIsoCode;

    protected ?string $iso_639_1 = null;

    protected ?string $english_name = null;

    protected ?string $name = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->iso_639_1 = $this->toString('iso_639_1');
        $this->english_name = $this->toString('english_name');
        $this->name = $this->toString('name');
    }

    /**
     * Get Language code ISO 639-1, like `fr`.
     */
    public function getIso6391(): ?string
    {
        return $this->iso_639_1;
    }

    /**
     * Get Language english name, like `French`.
     */
    public function getEnglishName(): ?string
    {
        return $this->english_name;
    }

    /**
     * Get Language name, like `Français`.
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
