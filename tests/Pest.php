<?php

function dotenvFile(): array
{
    $path = __DIR__.'/../';
    $lines = file($path.'.env');
    $dotenv = [];

    foreach ($lines as $line) {
        if (! empty($line)) {
            $data = explode('=', $line);
            $key = $data[0];
            if ($key === " \n ") {
                continue;
            }
            unset($data[0]);
            $value = implode('=', $data);

            $key = $key ? trim($key) : '';
            $value = $value ? trim($value) : '';

            if ($key === '') {
                continue;
            }

            $value = str_replace('"', '', $value);
            $value = str_replace("'", '', $value);

            $dotenv[$key] = $value;
        }
    }

    return $dotenv;
}

function dotenv(string $key): string
{
    return dotenvFile()[$key] ?? '';
}

function apiKey(): string
{
    return dotenv('TMDB_API_KEY');
}

function baseApp(): string
{
    return __DIR__.'/../';
}

function mediaPath(string $filename): string
{
    return baseApp().'tests/Media/'.$filename;
}

function fileExists(string $filename): bool
{
    return file_exists($filename);
}

function imageIsValid(string $filename): bool
{
    $image = @imagecreatefromstring(file_get_contents($filename));

    return $image !== false;
}

function imageExists(string $filename): bool
{
    return fileExists($filename) && imageIsValid($filename);
}

function clearMedia(): void
{
    $path = baseApp().'tests/Media/';
    $files = glob($path.'*');

    foreach ($files as $file) {
        if (is_file($file)) {
            if ($file !== '.gitignore') {
                unlink($file);
            }
        }
    }
}
