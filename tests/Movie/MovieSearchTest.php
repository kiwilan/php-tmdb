<?php

use Kiwilan\Tmdb\Models\TmdbMovie;
use Kiwilan\Tmdb\Query\SearchMovieQuery;
use Kiwilan\Tmdb\Results\MovieResults;
use Kiwilan\Tmdb\Tmdb;

it('can search movie', function () {
    $results = Tmdb::client(apiKey())
        ->search()
        ->movie('the fellowship of the ring');

    expect($results)->not()->toBeNull();
    expect($results)->toBeInstanceOf(MovieResults::class);
    expect($results->getResults())->toBeArray();
    expect($results->getResults())->not()->toBeEmpty();
    expect($results->getFirstResult())->toBeInstanceOf(TmdbMovie::class);
    expect($results->getTotalPages())->toBeInt();
    expect($results->getTotalResults())->toBeInt();
    expect($results->getPage())->toBeInt();

    $first = $results->getFirstResult();
    expect($first->isAdult())->toBeFalse();
    expect($first->getBackdropPath())->toBeString();
    expect($first->getGenreIds())->toBeArray();
    expect($first->getId())->toBeInt();
    expect($first->getOriginalLanguage())->toBeString();
    expect($first->getOriginalTitle())->toBeString();
    expect($first->getOverview())->toBeString();
    expect($first->getPopularity())->toBeFloat();
    expect($first->getPosterPath())->toBeString();
    expect($first->getReleaseDate())->toBeInstanceOf(DateTime::class);
    expect($first->getTitle())->toBeString();
    expect($first->getVoteAverage())->toBeFloat();
    expect($first->getVoteCount())->toBeInt();
});

it('can search movie with options', function () {
    $results = Tmdb::client(apiKey())
        ->search()
        ->movie('le seigneur des anneaux', new SearchMovieQuery(
            include_adult: true,
            language: 'fr-FR',
            primary_release_year: 2001,
            page: 1,
            region: 'en-US',
            year: 2001,
        ));

    expect($results)->not()->toBeNull();
    expect($results)->toBeInstanceOf(MovieResults::class);
    expect($results->getResults())->toBeArray();
    expect($results->getResults())->not()->toBeEmpty();
    expect($results->getFirstResult())->toBeInstanceOf(TmdbMovie::class);
    expect($results->getFirstResult()->getTitle())->toBe("Le Seigneur des anneaux : La Communauté de l'anneau");
});

it('can have null movie results', function () {
    $results = new MovieResults(null);

    expect($results->getPage())->toBe(1);
    expect($results->getTotalPages())->toBe(1);
    expect($results->getTotalResults())->toBe(0);
    expect($results->getResults())->toBeArray();
});
