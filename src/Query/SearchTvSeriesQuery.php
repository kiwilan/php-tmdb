<?php

namespace Kiwilan\Tmdb\Query;

class SearchTvSeriesQuery
{
    /**
     * @param  string|null  $first_air_date_year  The first air date year
     * @param  bool  $include_adult  Include adult content, default is `false`
     * @param  string  $language  The language, default is `en-US`
     * @param  int  $page  The page number, default is `1`
     * @param  int|null  $year  The year
     */
    public function __construct(
        public ?string $first_air_date_year = null,
        public bool $include_adult = false,
        public string $language = 'en-US',
        public int $page = 1,
        public ?int $year = null,
    ) {}

    public function toQueryParams(): array
    {
        return [
            'first_air_date_year' => $this->first_air_date_year,
            'include_adult' => $this->include_adult,
            'language' => $this->language,
            'page' => $this->page,
            'year' => $this->year,
        ];
    }
}
