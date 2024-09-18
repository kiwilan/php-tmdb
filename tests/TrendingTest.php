<?php

use Kiwilan\Tmdb\Enums\TmdbMediaType;
use Kiwilan\Tmdb\Enums\TmdbTimeWindow;
use Kiwilan\Tmdb\Models\Credits\TmdbPerson;
use Kiwilan\Tmdb\Models\TmdbMedia;
use Kiwilan\Tmdb\Models\TmdbMovie;
use Kiwilan\Tmdb\Models\TmdbTvSeries;
use Kiwilan\Tmdb\Results;
use Kiwilan\Tmdb\Tmdb;

it('can use all', function () {
    $all = Tmdb::client(apiKey())
        ->trending()
        ->all(TmdbTimeWindow::WEEK, 'fr-FR');

    expect($all)->toBeInstanceOf(Results\MediaResults::class);

    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(TmdbMedia::class);
    expect($all->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(TmdbMedia::class));
    ray($all);

    $first = $all->getFirstResult();
    expect($first)->toBeInstanceOf(TmdbMedia::class);
    expect($first->getMediaType())->toBeInstanceOf(TmdbMediaType::class);
    expect($first->getTitle())->toBeString();

    if ($all->getFirstMovie()) {
        expect($all->getFirstMovie())->toBeInstanceOf(TmdbMovie::class);
    }

    if ($all->getFirstTvSeries()) {
        expect($all->getFirstTvSeries())->toBeInstanceOf(TmdbTvSeries::class);
    }

    if ($all->getFirstPerson()) {
        expect($all->getFirstPerson())->toBeInstanceOf(TmdbPerson::class);
    }
});

it('can use movies', function () {
    $all = Tmdb::client(apiKey())
        ->trending()
        ->movies();

    expect($all)->toBeInstanceOf(Results\MovieResults::class);

    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(TmdbMovie::class);
    expect($all->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(TmdbMovie::class));
});

it('can use people', function () {
    $all = Tmdb::client(apiKey())
        ->trending()
        ->people();

    expect($all)->toBeInstanceOf(Results\PeopleResults::class);

    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(TmdbPerson::class);
    expect($all->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(TmdbPerson::class));
});

it('can use tv', function () {
    $all = Tmdb::client(apiKey())
        ->trending()
        ->tv();

    expect($all)->toBeInstanceOf(Results\TvSerieResults::class);

    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(TmdbTvSeries::class);
    expect($all->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(TmdbTvSeries::class));
});
