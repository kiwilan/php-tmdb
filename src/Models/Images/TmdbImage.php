<?php

namespace Kiwilan\Tmdb\Models\Images;

use Kiwilan\Tmdb\Enums\TmdbImageType;
use Kiwilan\Tmdb\Models\TmdbModel;

class TmdbImage extends TmdbModel
{
    protected ?float $aspect_ratio = null;

    protected ?int $height = null;

    protected ?string $iso_639_1 = null;

    protected ?string $file_path = null;

    protected ?float $vote_average = null;

    protected ?int $vote_count = null;

    protected ?int $width = null;

    protected ?TmdbImageType $type = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->aspect_ratio = $this->toFloat('aspect_ratio');
        $this->height = $this->toInt('height');
        $this->iso_639_1 = $this->toString('iso_639_1');
        $this->file_path = $this->toString('file_path');
        $this->vote_average = $this->toFloat('vote_average');
        $this->vote_count = $this->toInt('vote_count');
        $this->width = $this->toInt('width');
    }

    public function getAspectRatio(): ?float
    {
        return $this->aspect_ratio;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function getIso6391(): ?string
    {
        return $this->iso_639_1;
    }

    public function getFilePath(): ?string
    {
        return $this->file_path;
    }

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    public function getVoteCount(): ?int
    {
        return $this->vote_count;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * To know the image type: backdrop, poster, profile, logo, still.
     */
    public function getType(): ?TmdbImageType
    {
        return $this->type;
    }
}
