<?php

namespace Kiwilan\Tmdb\Utils;

class TmdbUrl
{
    public const TMDB_URL = 'https://www.themoviedb.org';

    public const API_V3_URL = 'https://api.themoviedb.org/3';

    public const IMAGE_URL = 'https://image.tmdb.org/t/p/';

    public const YOUTUBE_URL = 'https://www.youtube.com/watch?v=';

    public static function fixUrl(?string $url): ?string
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
