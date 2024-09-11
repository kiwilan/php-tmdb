<?php

use Kiwilan\Tmdb\Models\Search\SearchTvSeries;
use Kiwilan\Tmdb\Models\TvSeries;
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
    expect($first->getGenres())->toBeArray();
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
