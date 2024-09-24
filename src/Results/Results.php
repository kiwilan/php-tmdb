<?php

namespace Kiwilan\Tmdb\Results;

use Kiwilan\Tmdb\Models\TmdbModel;

abstract class Results extends TmdbModel
{
    protected ?array $results = [];

    protected int $page = 1;

    protected int $total_pages = 1;

    protected int $total_results = 0;

    public function __construct(?array $data)
    {
        parent::__construct($data);

        $this->page = $this->toInt('page', 1);
        $this->total_pages = $this->toInt('total_pages', 1);
        $this->total_results = $this->toInt('total_results', 0);
    }

    /**
     * Get the first result.
     */
    abstract public function getFirstResult(): ?TmdbModel;

    /**
     * Get the last result.
     */
    abstract public function getLastResult(): ?TmdbModel;

    /**
     * Get the search results.
     */
    abstract public function getResults(): array;

    /**
     * Filter the results.
     *
     * ```php
     * // Example: Get all movies with more than 1000 votes.
     * $very_popular = $all->filter(fn (TmdbMovie $movie) => $movie->getVoteCount() > 1000);
     * ```
     */
    abstract public function filter(\Closure $closure): array;

    /**
     * Filter to find the first result.
     *
     * ```php
     * // Example: Get the first movie with more than 1000 votes.
     * $very_popular = $all->find(fn (TmdbMovie $movie) => $movie->getVoteCount() > 1000);
     * ```
     */
    abstract public function find(\Closure $closure): mixed;

    /**
     * Get the page number.
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * Get the total pages.
     */
    public function getTotalPages(): int
    {
        return $this->total_pages;
    }

    /**
     * Get the total results.
     */
    public function getTotalResults(): int
    {
        return $this->total_results;
    }

    /**
     * Get the count of results of the current page.
     */
    public function getCountResults(): int
    {
        return count($this->results);
    }

    protected function getFirst(): mixed
    {
        return $this->results[0] ?? null;
    }

    protected function getLast(): mixed
    {
        return $this->results[count($this->results) - 1] ?? null;
    }

    protected function filterResults(\Closure $closure): array
    {
        $results = array_filter($this->results, $closure);

        return array_values($results);
    }

    protected function findResults(\Closure $closure): mixed
    {
        $results = $this->filter($closure);

        return $results[0] ?? null;
    }
}
