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

    $media = $all->filter(fn (TmdbMedia $media) => $media->getMedia() !== null);
    expect($media)->toBeArray();
    expect($media)->not()->toBeEmpty();
    expect($media)->each(fn (Pest\Expectation $media) => expect($media->value)->toBeInstanceOf(TmdbMedia::class));

    $media = $all->find(fn (TmdbMedia $media) => $media->getMedia() !== null);
    expect($media)->toBeInstanceOf(TmdbMedia::class);

    expect($all->getFirstResult())->toBeInstanceOf(TmdbMedia::class);
    expect($all->getLastResult())->toBeInstanceOf(TmdbMedia::class);
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

    $very_popular = $all->filter(fn (TmdbMovie $movie) => $movie->getVoteCount() > 1000);
    expect($very_popular)->toBeArray();
    if (! empty($very_popular)) {
        expect($very_popular)->not()->toBeEmpty();
        expect($very_popular)->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(TmdbMovie::class));
    }

    $very_popular = $all->find(fn (TmdbMovie $movie) => $movie->getVoteCount() > 1000);
    expect($very_popular)->toBeInstanceOf(TmdbMovie::class);

    expect($all->getFirstResult())->toBeInstanceOf(TmdbMovie::class);
    expect($all->getLastResult())->toBeInstanceOf(TmdbMovie::class);

    expect($all->getCountResults())->toBeInt();
    expect($all->getPage())->toBeInt();
    expect($all->getTotalPages())->toBeInt();
    expect($all->getTotalResults())->toBeInt();
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

    $persons = $all->filter(fn (TmdbPerson $person) => $person->getProfilePath() !== null);
    expect($persons)->toBeArray();
    expect($persons)->not()->toBeEmpty();
    expect($persons)->each(fn (Pest\Expectation $person) => expect($person->value)->toBeInstanceOf(TmdbPerson::class));

    $person = $all->find(fn (TmdbPerson $person) => $person->getProfilePath() !== null);
    expect($person)->toBeInstanceOf(TmdbPerson::class);

    expect($all->getFirstResult())->toBeInstanceOf(TmdbPerson::class);
    expect($all->getLastResult())->toBeInstanceOf(TmdbPerson::class);
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

    $tv = $all->filter(fn (TmdbTvSeries $tv) => $tv->getPosterPath() !== null);
    expect($tv)->toBeArray();
    expect($tv)->not()->toBeEmpty();
    expect($tv)->each(fn (Pest\Expectation $tv) => expect($tv->value)->toBeInstanceOf(TmdbTvSeries::class));

    $tv = $all->find(fn (TmdbTvSeries $tv) => $tv->getPosterPath() !== null);
    expect($tv)->toBeInstanceOf(TmdbTvSeries::class);

    expect($all->getFirstResult())->toBeInstanceOf(TmdbTvSeries::class);
    expect($all->getLastResult())->toBeInstanceOf(TmdbTvSeries::class);
});
