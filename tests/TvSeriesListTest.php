<?php

use Kiwilan\Tmdb\Models\TmdbTvSeries;
use Kiwilan\Tmdb\Results;
use Kiwilan\Tmdb\Tmdb;

it('can use airing today', function () {
    $all = Tmdb::client(apiKey())
        ->tvSeriesList()
        ->airingToday();

    expect($all)->toBeInstanceOf(Results\TvSerieResults::class);
    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(TmdbTvSeries::class);
    expect($all->getResults())->each(fn (Pest\Expectation $tv) => expect($tv->value)->toBeInstanceOf(TmdbTvSeries::class));
});

it('can use on the air', function () {
    $all = Tmdb::client(apiKey())
        ->tvSeriesList()
        ->onTheAir();

    expect($all)->toBeInstanceOf(Results\TvSerieResults::class);
    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(TmdbTvSeries::class);
    expect($all->getResults())->each(fn (Pest\Expectation $tv) => expect($tv->value)->toBeInstanceOf(TmdbTvSeries::class));
});

it('can use popular', function () {
    $all = Tmdb::client(apiKey())
        ->tvSeriesList()
        ->popular();

    expect($all)->toBeInstanceOf(Results\TvSerieResults::class);
    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(TmdbTvSeries::class);
    expect($all->getResults())->each(fn (Pest\Expectation $tv) => expect($tv->value)->toBeInstanceOf(TmdbTvSeries::class));
});

it('can use top rated', function () {
    $all = Tmdb::client(apiKey())
        ->tvSeriesList()
        ->topRated();

    expect($all)->toBeInstanceOf(Results\TvSerieResults::class);
    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(TmdbTvSeries::class);
    expect($all->getResults())->each(fn (Pest\Expectation $tv) => expect($tv->value)->toBeInstanceOf(TmdbTvSeries::class));
});
