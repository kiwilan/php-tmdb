<?php

use Kiwilan\Tmdb\Models\Company;
use Kiwilan\Tmdb\Models\Country;
use Kiwilan\Tmdb\Models\Genre;
use Kiwilan\Tmdb\Models\Movie;
use Kiwilan\Tmdb\Models\Movie\AlternativeTitle;
use Kiwilan\Tmdb\Models\Movie\BelongsToCollection;
use Kiwilan\Tmdb\Models\Movie\ReleaseDate;
use Kiwilan\Tmdb\Models\Search\SearchMovies;
use Kiwilan\Tmdb\Tmdb;

it('can search movie', function () {
    $results = Tmdb::client(apiKey())->searchMovie('the fellowship of the ring');

    expect($results)->not()->toBeNull();
    expect($results)->toBeInstanceOf(SearchMovies::class);
    expect($results->getResults())->toBeArray();
    expect($results->getResults())->not()->toBeEmpty();
    expect($results->getFirstResult())->toBeInstanceOf(Movie::class);
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
    expect($first->getReleaseDate())->toBeString();
    expect($first->getTitle())->toBeString();
    expect($first->isVideo())->toBeFalse();
    expect($first->getVoteAverage())->toBeFloat();
    expect($first->getVoteCount())->toBeInt();
});

it('can get movie details (tmdb id)', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120);
    expect($movie)->not()->toBeNull();
    expect($movie)->toBeInstanceOf(Movie::class);

    expect($movie->isAdult())->toBeFalse();
    expect($movie->getBackdropPath())->toBeString();
    expect($movie->getBelongsToCollection())->toBeInstanceOf(BelongsToCollection::class);
    expect($movie->getBudget())->toBeInt();

    expect($movie->getGenres())->toBeArray();
    expect($movie->getGenres())->not()->toBeEmpty();
    expect($movie->getGenres())->each(fn (Pest\Expectation $genre) => expect($genre->value)->toBeInstanceOf(Genre::class));

    expect($movie->getHomepage())->toBeString();
    expect($movie->getId())->toBeInt();
    expect($movie->getImdbId())->toBeString();
    expect($movie->getOriginalLanguage())->toBeString();
    expect($movie->getOriginalTitle())->toBeString();
    expect($movie->getOverview())->toBeString();
    expect($movie->getPopularity())->toBeFloat();
    expect($movie->getPosterPath())->toBeString();

    expect($movie->getProductionCompanies())->toBeArray();
    expect($movie->getProductionCompanies())->not()->toBeEmpty();
    expect($movie->getProductionCompanies())->each(fn (Pest\Expectation $company) => expect($company->value)->toBeInstanceOf(Company::class));

    expect($movie->getProductionCountries())->toBeArray();
    expect($movie->getProductionCountries())->not()->toBeEmpty();
    expect($movie->getProductionCountries())->each(fn (Pest\Expectation $country) => expect($country->value)->toBeInstanceOf(Country::class));

    // expect($movie->getReleaseDate())->toBeString();
    expect($movie->getRevenue())->toBeInt();
});

it('can get movie alternative titles', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120, 'alternative_titles');
    expect($movie->getAlternativeTitles())->not()->toBeNull();
    expect($movie->getAlternativeTitle('FR'))->toBeInstanceOf(AlternativeTitle::class);
    expect($movie->getAlternativeTitle('US'))->toBeInstanceOf(AlternativeTitle::class);
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

// credits,recommendations,similar

it('can get null if movie not exists (tmdb id)', function () {
    $movie = Tmdb::client(apiKey())->getMovie(50000000);
    expect($movie)->toBeNull();
});
