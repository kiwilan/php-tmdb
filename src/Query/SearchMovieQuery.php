<?php

namespace Kiwilan\Tmdb\Query;

class SearchMovieQuery
{
    /**
     * @param  bool  $includeAdult  Include adult content
     * @param  string  $language  The language, default is `en-US`
     * @param  int|null  $primaryReleaseYear  The primary release year
     * @param  int  $page  The page number
     * @param  string|null  $region  The region
     * @param  int|null  $year  The year
     */
    public function __construct(
        public bool $includeAdult = false,
        public string $language = 'en-US',
        public ?int $primaryReleaseYear = null,
        public int $page = 1,
        public ?string $region = null,
        public ?int $year = null,
    ) {}

    public function toQueryParams(): array
    {
        return [
            'include_adult' => $this->includeAdult,
            'language' => $this->language,
            'primary_release_year' => $this->primaryReleaseYear,
            'page' => $this->page,
            'region' => $this->region,
            'year' => $this->year,
        ];
    }
}
