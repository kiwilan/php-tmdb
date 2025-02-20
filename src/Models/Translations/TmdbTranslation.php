<?php

namespace Kiwilan\Tmdb\Models\Translations;

use Kiwilan\Tmdb\Models\TmdbModel;

/**
 * A translation for a media.
 */
class TmdbTranslation extends TmdbModel
{
    protected ?string $iso_3166_1 = null;

    protected ?string $iso_639_1 = null;

    protected ?string $name = null;

    protected ?string $english_name = null;

    /** @var string[]|null */
    protected ?array $data = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->iso_3166_1 = $this->toString('iso_3166_1');
        $this->iso_639_1 = $this->toString('iso_639_1');
        $this->name = $this->toString('name');
        $this->english_name = $this->toString('english_name');
        $this->data = $this->toArray('data');
    }

    /**
     * Get ISO 3166-1 code, like `DE`.
     *
     * @docs https://en.wikipedia.org/wiki/ISO_3166-1
     */
    public function getIso3166(): ?string
    {
        return $this->iso_3166_1;
    }

    /**
     * Get ISO 639-1 code, like `de`.
     *
     * @docs https://en.wikipedia.org/wiki/List_of_ISO_639_language_codes
     */
    public function getIso639(): ?string
    {
        return $this->iso_639_1;
    }

    /**
     * Get the name of the translation, like `Deutsch`.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get the English name of the translation, like `German`.
     */
    public function getEnglishName(): ?string
    {
        return $this->english_name;
    }

    /**
     * Get the data of the translation.
     *
     * @return array<string, string|int>|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * Get a specific data key of the translation.
     */
    public function getDataKey(string $key): string|int|null
    {
        return $this->data[$key] ?? null;
    }
}
