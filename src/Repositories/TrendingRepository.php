<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Enums\TimeWindow;
use Kiwilan\Tmdb\Results;

class TrendingRepository extends Repository
{
    /**
     * Get the trending movies, TV shows and people.
     *
     * @param  TimeWindow  $time_window  The TMDB TV series ID
     * @param  string  $language  The season number
     *
     * @docs https://developer.themoviedb.org/reference/trending-all
     */
    public function all(TimeWindow $time_window = TimeWindow::DAY, string $language = 'en-US'): ?Results\MediaResults
    {
        $url = $this->getUrl("/trending/all/{$time_window->value}", [
            'language' => $language,
        ]);

        $response = $this->execute($url);

        return $this->isSuccess ? new Results\MediaResults($response) : null;
    }
}
