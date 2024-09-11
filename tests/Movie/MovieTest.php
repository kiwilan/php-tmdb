<?php

use Kiwilan\Tmdb\Models\Company;
use Kiwilan\Tmdb\Models\Country;
use Kiwilan\Tmdb\Models\Genre;
use Kiwilan\Tmdb\Models\Movie;
use Kiwilan\Tmdb\Models\Movie\AlternativeTitle;
use Kiwilan\Tmdb\Models\Movie\BelongsToCollection;
use Kiwilan\Tmdb\Models\Movie\ReleaseDate;
use Kiwilan\Tmdb\Tmdb;

it('can get movie details (tmdb id)', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120);
    expect($movie)->not()->toBeNull();
    expect($movie)->toBeInstanceOf(Movie::class);

    expect($movie->isAdult())->toBeFalse();
    expect($movie->getBelongsToCollection())->toBeInstanceOf(BelongsToCollection::class);
    expect($movie->getBudget())->toBeInt();

    expect($movie->getGenres())->toBeArray();
    expect($movie->getGenres())->not()->toBeEmpty();
    expect($movie->getGenres())->each(fn (Pest\Expectation $genre) => expect($genre->value)->toBeInstanceOf(Genre::class));

    expect($movie->getPosterPath())->toStartWith('/');
    expect($movie->getBackdropPath())->toStartWith('/');

    expect($movie->getHomepage())->toBeString();
    expect($movie->getId())->toBeInt();
    expect($movie->getImdbId())->toBeString();
    expect($movie->getOriginalLanguage())->toBeString();
    expect($movie->getOriginalTitle())->toBeString();
    expect($movie->getOverview())->toBeString();
    expect($movie->getPopularity())->toBeFloat();

    expect($movie->getProductionCompanies())->toBeArray();
    expect($movie->getProductionCompanies())->not()->toBeEmpty();
    expect($movie->getProductionCompanies())->each(fn (Pest\Expectation $company) => expect($company->value)->toBeInstanceOf(Company::class));

    expect($movie->getProductionCountries())->toBeArray();
    expect($movie->getProductionCountries())->not()->toBeEmpty();
    expect($movie->getProductionCountries())->each(fn (Pest\Expectation $country) => expect($country->value)->toBeInstanceOf(Country::class));

    expect($movie->getReleaseDate())->toBeInstanceOf(DateTime::class);
    expect($movie->getRevenue())->toBeInt();
});

it('can get movie alternative titles', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120, 'alternative_titles');
    expect($movie->getAlternativeTitles())->not()->toBeNull();
    expect($movie->getAlternativeTitle('FR'))->toBeInstanceOf(AlternativeTitle::class);
    expect($movie->getAlternativeTitle('US'))->toBeInstanceOf(AlternativeTitle::class);
});

it('can get movie posters', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120);

    expect($movie->getPosterUrl())->toStartWith('https://');
    expect($movie->getBackdropUrl())->toStartWith('https://');

    expect($movie->getPosterImage())->toBeString();
    expect($movie->getBackdropImage())->toBeString();

    clearMedia();

    $path = mediaPath('/poster-original.jpg');
    expect($movie->savePosterImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();

    $path = mediaPath('/backdrop-original.jpg');
    expect($movie->saveBackdropImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
});

it('can get movie release dates', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120, 'release_dates');

    expect($movie->getReleaseDates())->not()->toBeNull();
    $french = $movie->getReleaseDatesSpecific('FR');
    expect($french)->toBeInstanceOf(ReleaseDate::class);
    expect($french->getIso31661())->toBe('FR');
    expect($french->getReleaseDates())->toBeArray();
    expect($french->getFirstReleaseDate())->toBeInstanceOf(Movie\ReleaseDateItem::class);
    expect($french->getSpecificReleaseDate('Blu-Ray'))->toBeInstanceOf(Movie\ReleaseDateItem::class);
});

it('can get movie credits', function () {
    //
});

it('can get movie recommendations', function () {
    //
});

it('can get movie similar', function () {
    //
});

it('can get null if movie not exists (tmdb id)', function () {
    $movie = Tmdb::client(apiKey())->getMovie(50000000);
    expect($movie)->toBeNull();
});
