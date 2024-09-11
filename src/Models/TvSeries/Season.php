<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

class Season
{
    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }
    }
}
