<?php

use Kiwilan\Tmdb\Models\Movie;
use Kiwilan\Tmdb\Search;
use Kiwilan\Tmdb\Tmdb;

it('can use now playing', function () {
    $now_playing = Tmdb::client(apiKey())
        ->movieLists()
        ->nowPlaying('en-US', 1, 'US');

    expect($now_playing)->toBeInstanceOf(Search\SearchMoviesDates::class);

    expect($now_playing->getDates())->toBeInstanceOf(Search\Common\SearchDates::class);
    expect($now_playing->getDates()->getMinimum())->toBeInstanceOf(DateTime::class);
    expect($now_playing->getDates()->getMaximum())->toBeInstanceOf(DateTime::class);

    expect($now_playing->getResults())->toBeArray();
    expect($now_playing->getResults())->not()->toBeEmpty();
    expect($now_playing->getFirstResult())->toBeInstanceOf(Movie::class);
    expect($now_playing->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(Movie::class));
});

it('can use popular', function () {
    $popular = Tmdb::client(apiKey())
        ->movieLists()
        ->popular('en-US', 1, 'US');

    expect($popular)->toBeInstanceOf(Search\SearchMovies::class);

    expect($popular->getResults())->toBeArray();
    expect($popular->getResults())->not()->toBeEmpty();
    expect($popular->getFirstResult())->toBeInstanceOf(Movie::class);
    expect($popular->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(Movie::class));
});

it('can use top rated', function () {
    $top_rated = Tmdb::client(apiKey())
        ->movieLists()
        ->topRated('en-US', 1, 'US');

    expect($top_rated)->toBeInstanceOf(Search\SearchMovies::class);

    expect($top_rated->getResults())->toBeArray();
    expect($top_rated->getResults())->not()->toBeEmpty();
    expect($top_rated->getFirstResult())->toBeInstanceOf(Movie::class);
    expect($top_rated->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(Movie::class));
});

it('can use upcoming', function () {
    $upcoming = Tmdb::client(apiKey())
        ->movieLists()
        ->upcoming('en-US', 1, 'US');

    expect($upcoming)->toBeInstanceOf(Search\SearchMovies::class);

    expect($upcoming->getDates())->toBeInstanceOf(Search\Common\SearchDates::class);
    expect($upcoming->getDates()->getMinimum())->toBeInstanceOf(DateTime::class);
    expect($upcoming->getDates()->getMaximum())->toBeInstanceOf(DateTime::class);

    expect($upcoming->getResults())->toBeArray();
    expect($upcoming->getResults())->not()->toBeEmpty();
    expect($upcoming->getFirstResult())->toBeInstanceOf(Movie::class);
    expect($upcoming->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(Movie::class));
});
