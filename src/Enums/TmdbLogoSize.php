<?php

namespace Kiwilan\Tmdb\Enums;

/**
 * Logo sizes.
 *
 * @docs https://developer.themoviedb.org/reference/configuration-details
 */
enum TmdbLogoSize: string
{
    case W45 = 'w45';
    case W92 = 'w92';
    case W154 = 'w154';
    case W185 = 'w185';
    case W300 = 'w300';
    case W500 = 'w500';
    case ORIGINAL = 'original';
}
