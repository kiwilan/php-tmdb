<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

class ContentRating
{
    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }
    }
}
