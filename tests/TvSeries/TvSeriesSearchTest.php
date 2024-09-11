<?php

use Kiwilan\Tmdb\Models\Search\SearchTvSeries;
use Kiwilan\Tmdb\Models\TvSeries;
use Kiwilan\Tmdb\Query\SearchTvSeriesQuery;
use Kiwilan\Tmdb\Tmdb;

it('can search tv series', function () {
    $results = Tmdb::client(apiKey())->searchTvSeries('game of thrones');

    expect($results)->not()->toBeNull();
    expect($results)->toBeInstanceOf(SearchTvSeries::class);
    expect($results->getResults())->toBeArray();
    expect($results->getResults())->not()->toBeEmpty();
    expect($results->getFirstResult())->toBeInstanceOf(TvSeries::class);
    expect($results->getTotalPages())->toBeInt();
    expect($results->getTotalResults())->toBeInt();
    expect($results->getPage())->toBeInt();

    $first = $results->getFirstResult();
    expect($first->isAdult())->toBeFalse();
    expect($first->getBackdropPath())->toBeString();
    expect($first->getEpisodeRunTime())->toBeNull();
    expect($first->getFirstAirDate())->toBeInstanceOf(DateTime::class);
    expect($first->getGenreIds())->toBeArray();
    expect($first->getHomepage())->toBeNull();
    expect($first->getId())->toBeInt();
    expect($first->getOriginalLanguage())->toBeString();
    expect($first->getOverview())->toBeString();
    expect($first->getPopularity())->toBeFloat();
    expect($first->getPosterPath())->toBeString();
    expect($first->getName())->toBeString();
    expect($first->getVoteAverage())->toBeFloat();
    expect($first->getVoteCount())->toBeInt();
});

it('can search movie with options', function () {
    $results = Tmdb::client(apiKey())->searchTvSeries('game of thrones', new SearchTvSeriesQuery(
        first_air_date_year: 2011,
        include_adult: true,
        language: 'fr-FR',
        page: 1,
        year: 2011,
    ));

    expect($results)->not()->toBeNull();
    expect($results)->toBeInstanceOf(SearchTvSeries::class);
    expect($results->getResults())->toBeArray();
    expect($results->getResults())->not()->toBeEmpty();
    expect($results->getFirstResult())->toBeInstanceOf(TvSeries::class);
    expect($results->getFirstResult()->getName())->toBe('Game of Thrones');
});
