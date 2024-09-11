<?php

namespace Kiwilan\Tmdb\Enums;

/**
 * Poster sizes.
 *
 * @docs https://www.themoviedb.org/talk/568e3711c3a36858fc002384
 */
enum PosterSize: string
{
    case W92 = 'w92';
    case W154 = 'w154';
    case W185 = 'w185';
    case W342 = 'w342';
    case W500 = 'w500';
    case W780 = 'w780';
    case ORIGINAL = 'original';
}
