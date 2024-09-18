<?php

namespace Kiwilan\Tmdb\Enums;

/**
 * Still sizes.
 *
 * @docs https://developer.themoviedb.org/reference/configuration-details
 */
enum TmdbStillSize: string
{
    case W92 = 'w92';
    case W185 = 'w185';
    case W300 = 'w300';
    case ORIGINAL = 'original';
}
