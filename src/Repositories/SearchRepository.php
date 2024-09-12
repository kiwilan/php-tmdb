<?php

namespace Kiwilan\Tmdb\Repositories;

use Kiwilan\Tmdb\Query;
use Kiwilan\Tmdb\Search;

/**
 * Search repository
 *
 * @docs https://developer.themoviedb.org/reference/search-collection
 */
class SearchRepository extends Repository
{
    /**
     * Search for movies by their original, translated and alternative titles.
     *
     * @param  string  $query  The search query
     * @param  Query\SearchMovieQuery  $params  The search query parameters for additional information
     *
     * @docs https://developer.themoviedb.org/reference/search-movie
     */
    public function movie(string $query, Query\SearchMovieQuery $params = new Query\SearchMovieQuery): Search\SearchMovies
    {
        $url = $this->getUrl('/search/movie', [
            'query' => $query,
            ...$params->toQueryParams(),
        ]);

        $response = $this->execute($url);

        return new Search\SearchMovies($response);
    }

    /**
     * Search for TV shows by their original, translated and also known as names.
     *
     * @param  string  $query  The search query
     * @param  Query\SearchTvSeriesQuery  $params  The search query parameters for additional information
     *
     * @docs https://developer.themoviedb.org/reference/search-tv
     */
    public function tv(string $query, Query\SearchTvSeriesQuery $params = new Query\SearchTvSeriesQuery): Search\SearchTvSeries
    {
        $url = $this->getUrl('/search/tv', [
            'query' => $query,
            ...$params->toQueryParams(),
        ]);

        $response = $this->execute($url);

        return new Search\SearchTvSeries($response);
    }

    /**
     * Search for collections by their original, translated and alternative names.
     *
     * @param  string  $query  The search query
     * @param  Query\SearchCollectionQuery  $params  The search query parameters for additional information
     *
     * @docs https://developer.themoviedb.org/reference/search-collection
     */
    public function collection(string $query, Query\SearchCollectionQuery $params = new Query\SearchCollectionQuery): Search\SearchCollections
    {
        $url = $this->getUrl('/search/collection', [
            'query' => $query,
            ...$params->toQueryParams(),
        ]);

        $response = $this->execute($url);

        return new Search\SearchCollections($response);
    }
}
