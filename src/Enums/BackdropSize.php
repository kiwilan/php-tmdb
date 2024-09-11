<?php

namespace Kiwilan\Tmdb\Enums;

/**
 * Backdrop sizes.
 *
 * @docs https://developer.themoviedb.org/reference/configuration-details
 */
enum BackdropSize: string
{
    case W300 = 'w300';
    case W780 = 'w780';
    case W1280 = 'w1280';
    case ORIGINAL = 'original';
}
