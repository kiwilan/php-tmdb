<?php

use Kiwilan\Tmdb\Enums\TimeWindow;
use Kiwilan\Tmdb\Models\Credits\Person;
use Kiwilan\Tmdb\Models\Media;
use Kiwilan\Tmdb\Models\Movie;
use Kiwilan\Tmdb\Models\TvSeries;
use Kiwilan\Tmdb\Results;
use Kiwilan\Tmdb\Tmdb;

it('can use all', function () {
    $all = Tmdb::client(apiKey())
        ->trending()
        ->all(TimeWindow::WEEK, 'fr-FR');

    expect($all)->toBeInstanceOf(Results\MediaResults::class);

    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(Media::class);
    expect($all->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(Media::class));

    $first = $all->getFirstResult();
    expect($first->getTitle())->toBeString();
    expect($first->getOriginalTitle())->toBeString();
    expect($first->getFirstAirDate())->toBeInstanceOf(DateTime::class);
});

it('can use media', function () {
    $all = Tmdb::client(apiKey())
        ->trending()
        ->all();

    $first = $all->getFirstResult();
    expect($first)->toBeInstanceOf(Media::class);

    expect($first->getId())->toBeInt();
    expect($first->getTitle())->toBeString();
    expect($first->getOriginalTitle())->toBeString();
    expect($first->getOverview())->toBeString();
    expect($first->getPosterPath())->toBeString();
    expect($first->getMediaType())->toBeString();
    expect($first->isAdult())->toBeBool();
    expect($first->getOriginalLanguage())->toBeString();
    expect($first->getGenreIds())->toBeArray();
    expect($first->getPopularity())->toBeFloat();
    expect($first->getVideos())->toBeNull();
    expect($first->getVoteAverage())->toBeFloat();
    expect($first->getVoteCount())->toBeInt();
    expect($first->getGenreIds())->toBeArray();
    expect($first->getBackdropPath())->toBeString();
    expect($first->getReleaseDate())->toBeInstanceOf(DateTime::class);
});

it('can use movies', function () {
    $all = Tmdb::client(apiKey())
        ->trending()
        ->movies();

    expect($all)->toBeInstanceOf(Results\MovieResults::class);

    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(Movie::class);
    expect($all->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(Movie::class));
});

it('can use people', function () {
    $all = Tmdb::client(apiKey())
        ->trending()
        ->people();

    expect($all)->toBeInstanceOf(Results\PeopleResults::class);

    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(Person::class);
    expect($all->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(Person::class));
});

it('can use tv', function () {
    $all = Tmdb::client(apiKey())
        ->trending()
        ->tv();

    expect($all)->toBeInstanceOf(Results\TvSerieResults::class);

    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(TvSeries::class);
    expect($all->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(TvSeries::class));
});
