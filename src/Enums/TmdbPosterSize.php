<?php

namespace Kiwilan\Tmdb\Enums;

/**
 * Poster sizes.
 *
 * @docs https://developer.themoviedb.org/reference/configuration-details
 */
enum TmdbPosterSize: string
{
    case W92 = 'w92';
    case W154 = 'w154';
    case W185 = 'w185';
    case W342 = 'w342';
    case W500 = 'w500';
    case W780 = 'w780';
    case ORIGINAL = 'original';
}
