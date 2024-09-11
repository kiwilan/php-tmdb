<?php

namespace Kiwilan\Tmdb\Query;

class SearchCollectionQuery
{
    /**
     * @param  bool  $include_adult  Include adult content, default is `false`
     * @param  string  $language  The language, default is `en-US`
     * @param  int  $page  The page number, default is `1`
     * @param  int|null  $year  The year
     */
    public function __construct(
        public bool $include_adult = false,
        public string $language = 'en-US',
        public int $page = 1,
        public ?int $year = null,
    ) {}

    public function toQueryParams(): array
    {
        return [
            'include_adult' => $this->include_adult,
            'language' => $this->language,
            'page' => $this->page,
            'year' => $this->year,
        ];
    }
}
