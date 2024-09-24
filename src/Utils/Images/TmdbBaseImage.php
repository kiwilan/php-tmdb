<?php

namespace Kiwilan\Tmdb\Utils\Images;

use BackedEnum;
use Kiwilan\Tmdb\Utils\TmdbUrl;

abstract class TmdbBaseImage
{
    protected ?string $image_path = null;

    protected ?BackedEnum $size = null;

    /**
     * Create a new instance.
     *
     * @param  ?string  $url  The image path, like `/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg`
     */
    abstract public static function make(?string $url): self;

    /**
     * Get full poster URL.
     */
    public function getUrl(): ?string
    {
        if (! $this->image_path) {
            return null;
        }

        $url = TmdbUrl::IMAGE_URL;

        return "{$url}{$this->size->value}{$this->image_path}";
    }

    /**
     * Get the image content, as binary.
     */
    public function getImage(): ?string
    {
        $url = $this->getUrl();
        if (! $url) {
            return null;
        }

        $client = new \GuzzleHttp\Client;
        $response = $client->request('GET', $url, [
            'http_errors' => false,
        ]);

        $contents = $response->getBody()->getContents();

        return $contents !== '' ? $contents : null;
    }

    /**
     * Save the image to a file.
     */
    public function saveImage(?string $path): bool
    {
        if (! $path) {
            return false;
        }

        $contents = $this->getImage();
        if ($contents === null) {
            return false;
        }

        return file_put_contents($path, $contents) !== false;
    }
}
