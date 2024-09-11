<?php

use Kiwilan\Tmdb\Models\Common\AlternativeTitle;
use Kiwilan\Tmdb\Models\Common\Company;
use Kiwilan\Tmdb\Models\Common\Country;
use Kiwilan\Tmdb\Models\Common\Genre;
use Kiwilan\Tmdb\Models\Common\SpokenLanguage;
use Kiwilan\Tmdb\Models\Credits\Cast;
use Kiwilan\Tmdb\Models\Credits\Crew;
use Kiwilan\Tmdb\Models\Movie;
use Kiwilan\Tmdb\Models\Movie\BelongsToCollection;
use Kiwilan\Tmdb\Models\Movie\ReleaseDate;
use Kiwilan\Tmdb\Tmdb;

it('can get movie details (tmdb id)', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120);
    expect($movie)->not()->toBeNull();
    expect($movie)->toBeInstanceOf(Movie::class);

    expect($movie->isAdult())->toBeFalse();

    expect($movie->getBelongsToCollection())->toBeInstanceOf(BelongsToCollection::class);
    expect($movie->getBelongsToCollection()->getId())->toBe(119);
    expect($movie->getBelongsToCollection()->getName())->toBe('The Lord of the Rings Collection');
    expect($movie->getBelongsToCollection()->getPosterPath())->toBeString();
    expect($movie->getBelongsToCollection()->getBackdropPath())->toBeString();

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
    expect($movie->getOriginCountry())->toBeArray();
    expect($movie->getOverview())->toBeString();
    expect($movie->getPopularity())->toBeFloat();
    expect($movie->getRuntime())->toBeInt();

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
    $movie = Tmdb::client(apiKey())->getMovie(120, 'credits');

    expect($movie->getCredits())->not()->toBeNull();
    expect($movie->getCredits()->getCast())->toBeArray();
    expect($movie->getCredits()->getCast())->not()->toBeEmpty();
    expect($movie->getCredits()->getCast())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(Cast::class));

    expect($movie->getCredits()->getCrew())->toBeArray();
    expect($movie->getCredits()->getCrew())->not()->toBeEmpty();
    expect($movie->getCredits()->getCrew())->each(fn (Pest\Expectation $crew) => expect($crew->value)->toBeInstanceOf(Crew::class));
});

it('can get movie spoken languages', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120, 'credits');

    expect($movie->getSpokenLanguages())->not()->toBeNull();
    expect($movie->getSpokenLanguages())->toBeArray();
    expect($movie->getSpokenLanguages())->not()->toBeEmpty();
    expect($movie->getSpokenLanguages())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(SpokenLanguage::class));
});

it('can get movie recommendations', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120, 'recommendations');
    $recommendations = $movie->getRecommendations();

    expect($recommendations)->not()->toBeNull();
    expect($recommendations->getResults())->toBeArray();
    expect($recommendations->getResults())->not()->toBeEmpty();
    expect($recommendations->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(Movie::class));
});

it('can get movie similar', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120, 'similar');
    $similar = $movie->getSimilar();

    expect($similar)->not()->toBeNull();
    expect($similar->getResults())->toBeArray();
    expect($similar->getResults())->not()->toBeEmpty();
    expect($similar->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(Movie::class));
});

it('can get null if movie not exists (tmdb id)', function () {
    $movie = Tmdb::client(apiKey())->getMovie(50000000);
    expect($movie)->toBeNull();
});

it('can get movie companies', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120);
    $companies = $movie->getProductionCompanies();
    expect($companies)->toBeArray();
    expect($companies)->not()->toBeEmpty();
    expect($companies)->each(fn (Pest\Expectation $company) => expect($company->value)->toBeInstanceOf(Company::class));

    $first = reset($companies);
    expect($first->getId())->toBe(12);
    expect($first->getLogoPath())->toBeString();
    expect($first->getName())->toBe('New Line Cinema');
    expect($first->getOriginCountry())->toBe('US');
});

it('can get movie countries', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120);
    $countries = $movie->getProductionCountries();
    expect($countries)->toBeArray();
    expect($countries)->not()->toBeEmpty();
    expect($countries)->each(fn (Pest\Expectation $country) => expect($country->value)->toBeInstanceOf(Country::class));

    $first = reset($countries);
    expect($first->getIso31661())->toBe('NZ');
    expect($first->getName())->toBeString('New Zealand');
});

it('can get directors', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120, 'credits');

    $directors = $movie->getDirectors();
    expect(reset($directors)?->getName())->toBe('Peter Jackson');
});
