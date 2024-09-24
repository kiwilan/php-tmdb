<?php

namespace Kiwilan\Tmdb\Enums;

/**
 * Image types.
 */
enum TmdbImageType: string
{
    case BACKDROP = 'backdrop';
    case POSTER = 'poster';
    case PROFILE = 'profile';
    case LOGO = 'logo';
    case STILL = 'still';
}
