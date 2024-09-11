<?php

namespace Kiwilan\Tmdb\Utils;

use Kiwilan\Tmdb\Enums\PosterSize;

class TmdbPoster
{
    const BASE_URL = 'https://image.tmdb.org/t/p/';

    protected function __construct(
        protected string $posterUrl,
        protected PosterSize $size = PosterSize::ORIGINAL,
    ) {}

    /**
     * Create a new instance.
     *
     * @param  string  $posterUrl  The poster path, like `/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg`
     * @param  PosterSize  $size  The poster size, default is `PosterSize::ORIGINAL`
     */
    public static function make(string $posterUrl, PosterSize $size = PosterSize::ORIGINAL): self
    {
        if (! str_starts_with($posterUrl, '/')) {
            $posterUrl = "/{$posterUrl}";
        }

        return new self($posterUrl, $size);
    }

    /**
     * Get full poster URL.
     *
     * @param  ?PosterSize  $size  To override the poster size, default is size defined in the instance with `make()` method
     */
    public function getUrl(?PosterSize $size = null): string
    {
        if ($size) {
            $this->size = $size;
        }
        $url = self::BASE_URL;

        return "{$url}{$this->size->value}{$this->posterUrl}";
    }

    /**
     * Get the image content, as binary.
     *
     * @param  ?PosterSize  $size  To override the poster size, default is size defined in the instance with `make()` method
     */
    public function getImage(?PosterSize $size = null): string
    {
        $url = $this->getUrl($size);

        return file_get_contents($url);
    }

    /**
     * Save the image to a file.
     *
     * @param  ?PosterSize  $size  To override the poster size, default is size defined in the instance with `make()` method
     */
    public function saveImage(string $path, ?PosterSize $size = null): bool
    {
        $contents = $this->getImage($size);

        return file_put_contents($path, $contents) !== false;
    }
}
