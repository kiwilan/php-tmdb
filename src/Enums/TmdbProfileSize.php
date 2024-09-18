<?php

namespace Kiwilan\Tmdb\Enums;

/**
 * Profile sizes.
 *
 * @docs https://developer.themoviedb.org/reference/configuration-details
 */
enum TmdbProfileSize: string
{
    case W45 = 'w45';
    case W185 = 'w185';
    case H632 = 'h632';
    case ORIGINAL = 'original';
}
