<?php

namespace Kiwilan\Tmdb\Models;

class TmdbAlternativeTitle
{
    public ?int $id = null;

    /**
     * @var TmdbAlternativeTitleResult[]
     */
    public ?array $titles = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->id = $data['id'] ?? null;
        if (isset($data['titles']) && is_array($data['titles'])) {
            $this->titles = [];
            foreach ($data['titles'] as $titleData) {
                $this->titles[] = new TmdbAlternativeTitleResult($titleData);
            }
        }

        if (isset($data['results']) && is_array($data['results'])) {
            $this->titles = [];
            foreach ($data['results'] as $titleData) {
                $this->titles[] = new TmdbAlternativeTitleResult($titleData);
            }
        }
    }
}

class TmdbAlternativeTitleResult
{
    public ?string $iso_3166_1 = null;

    public ?string $title = null;

    public ?string $type = null;

    public function __construct(array $data)
    {
        $this->iso_3166_1 = $data['iso_3166_1'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->type = $data['type'] ?? null;
    }
}
