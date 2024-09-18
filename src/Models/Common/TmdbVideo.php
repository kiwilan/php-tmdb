<?php

namespace Kiwilan\Tmdb\Models\Common;

use DateTime;
use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Utils\TmdbUrl;

/**
 * A video of a movie.
 */
class TmdbVideo extends TmdbModel
{
    protected ?string $iso_639_1 = null;

    protected ?string $iso_3166_1 = null;

    protected ?string $name = null;

    protected ?string $key = null;

    protected ?string $site = null;

    protected ?int $size = null;

    protected ?string $type = null;

    protected bool $official = false;

    protected ?DateTime $published_at = null;

    protected ?string $id = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->iso_639_1 = $this->toString($data, 'iso_639_1');
        $this->iso_3166_1 = $this->toString($data, 'iso_3166_1');
        $this->name = $this->toString($data, 'name');
        $this->key = $this->toString($data, 'key');
        $this->site = $this->toString($data, 'site');
        $this->size = $this->toInt($data, 'size');
        $this->type = $this->toString($data, 'type');
        $this->official = $this->toBool($data, 'official');
        $this->published_at = $this->toDateTime($data, 'published_at');
        $this->id = $this->toString($data, 'id');
    }

    public function getIso6391(): ?string
    {
        return $this->iso_639_1;
    }

    public function getIso31661(): ?string
    {
        return $this->iso_3166_1;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function isOfficial(): bool
    {
        return $this->official;
    }

    public function getPublishedAt(): ?DateTime
    {
        return $this->published_at;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getYouTubeUrl(): ?string
    {
        if ($this->site !== 'YouTube') {
            return null;
        }

        return TmdbUrl::YOUTUBE_URL."{$this->key}";
    }
}
