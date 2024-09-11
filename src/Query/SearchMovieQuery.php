<?php

namespace Kiwilan\Tmdb\Query;

class SearchMovieQuery
{
    /**
     * @param  string|null  $primaryReleaseYear  The primary release year
     * @param  string|null  $region  The region
     * @param  bool  $includeAdult  Include adult content, default is `false`
     * @param  string  $language  The language, default is `en-US`
     * @param  int  $page  The page number, default is `1`
     * @param  int|null  $year  The year
     */
    public function __construct(
        public ?string $primaryReleaseYear = null,
        public ?string $region = null,
        public bool $includeAdult = false,
        public string $language = 'en-US',
        public int $page = 1,
        public ?int $year = null,
    ) {}

    public function toQueryParams(): array
    {
        return [
            'primary_release_year' => $this->primaryReleaseYear,
            'region' => $this->region,
            'include_adult' => $this->includeAdult,
            'language' => $this->language,
            'page' => $this->page,
            'year' => $this->year,
        ];
    }
}
