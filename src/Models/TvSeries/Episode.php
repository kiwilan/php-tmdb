<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

class Episode
{
    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }
    }
}
