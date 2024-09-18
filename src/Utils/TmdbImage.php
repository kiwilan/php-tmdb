<?php

namespace Kiwilan\Tmdb\Utils;

use BackedEnum;

abstract class TmdbImage
{
    protected ?string $imageUrl = null;

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
        if (! $this->imageUrl) {
            return null;
        }

        $url = TmdbUrl::IMAGE_URL;

        return "{$url}{$this->size->value}{$this->imageUrl}";
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

    protected function fixUrl(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        if (! str_starts_with($url, '/')) {
            $url = "/{$url}";
        }

        return $url;
    }
}
