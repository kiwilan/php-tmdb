<?php

namespace Kiwilan\Tmdb\Models\Translations;

use Kiwilan\Tmdb\Models\TmdbModel;

class TmdbTranslation extends TmdbModel
{
    protected ?string $iso_3166_1 = null;

    protected ?string $iso_639_1 = null;

    protected ?string $name = null;

    protected ?string $english_name = null;

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

    public function getIso31661(): ?string
    {
        return $this->iso_3166_1;
    }

    public function getIso6391(): ?string
    {
        return $this->iso_639_1;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEnglishName(): ?string
    {
        return $this->english_name;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * Get data key, safely return null if not found.
     */
    public function getDataKey(string $key): ?string
    {
        return $this->data[$key] ?? null;
    }
}
