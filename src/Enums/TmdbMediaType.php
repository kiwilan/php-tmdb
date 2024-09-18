<?php

namespace Kiwilan\Tmdb\Enums;

/**
 * Media type.
 */
enum TmdbMediaType: string
{
    case MOVIE = 'movie';
    case TV = 'tv';
    case PERSON = 'person';
}
