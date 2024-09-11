<?php

namespace Kiwilan\Tmdb\Query;

class SearchMovieQuery
{
    /**
     * @param  bool  $include_adult  Include adult content, default is `false`
     * @param  string  $language  The language, default is `en-US`
     * @param  int|null  $primary_release_year  The primary release year
     * @param  int  $page  The page number, default is `1`
     * @param  string|null  $region  The region
     * @param  string|null  $year  The year
     */
    public function __construct(
        public bool $include_adult = false,
        public string $language = 'en-US',
        public ?int $primary_release_year = null,
        public int $page = 1,
        public ?string $region = null,
        public ?string $year = null,
    ) {}

    public function toQueryParams(): array
    {
        return [
            'include_adult' => $this->include_adult,
            'language' => $this->language,
            'primary_release_year' => $this->primary_release_year,
            'page' => $this->page,
            'region' => $this->region,
            'year' => $this->year,
        ];
    }
}
