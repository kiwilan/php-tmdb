<?php

namespace Kiwilan\Tmdb\Query;

class SearchTvSeriesQuery
{
    /**
     * @param  string|null  $firstAirDateYear  The first air date year
     * @param  string|null  $region  The region
     * @param  bool  $includeAdult  Include adult content, default is `false`
     * @param  string  $language  The language, default is `en-US`
     * @param  int  $page  The page number, default is `1`
     * @param  int|null  $year  The year
     */
    public function __construct(
        public ?string $firstAirDateYear = null,
        public bool $includeAdult = false,
        public string $language = 'en-US',
        public int $page = 1,
        public ?string $region = null,
        public ?int $year = null,
    ) {}

    public function toQueryParams(): array
    {
        return [
            'first_air_date_year' => $this->firstAirDateYear,
            'include_adult' => $this->includeAdult,
            'language' => $this->language,
            'page' => $this->page,
            'region' => $this->region,
            'year' => $this->year,
        ];
    }
}
