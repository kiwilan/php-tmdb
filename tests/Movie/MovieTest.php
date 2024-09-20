<?php

use Kiwilan\Tmdb\Models\Common\TmdbAlternativeTitle;
use Kiwilan\Tmdb\Models\Common\TmdbCompany;
use Kiwilan\Tmdb\Models\Common\TmdbCountry;
use Kiwilan\Tmdb\Models\Common\TmdbGenre;
use Kiwilan\Tmdb\Models\Common\TmdbSpokenLanguage;
use Kiwilan\Tmdb\Models\Common\TmdbVideo;
use Kiwilan\Tmdb\Models\Credits\TmdbCast;
use Kiwilan\Tmdb\Models\Credits\TmdbCrew;
use Kiwilan\Tmdb\Models\Movie\TmdbReleaseDate;
use Kiwilan\Tmdb\Models\Movie\TmdbReleaseDateItem;
use Kiwilan\Tmdb\Models\TmdbCollection;
use Kiwilan\Tmdb\Models\TmdbMovie;
use Kiwilan\Tmdb\Tmdb;

it('can get movie details (tmdb id)', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(movie_id: 120);

    expect($movie)->not()->toBeNull();
    expect($movie)->toBeInstanceOf(TmdbMovie::class);

    expect($movie->isAdult())->toBeFalse();

    expect($movie->getCollection())->toBeInstanceOf(TmdbCollection::class);
    expect($movie->getCollection()->getId())->toBe(119);
    expect($movie->getCollection()->getName())->toBe('The Lord of the Rings Collection');
    expect($movie->getCollection()->getPosterPath())->toBeString();
    expect($movie->getCollection()->getBackdropPath())->toBeString();
    expect($movie->getCollection()->getTmdbUrl())->toBeString();

    expect($movie->getBudget())->toBeInt();

    expect($movie->getGenres())->toBeArray();
    expect($movie->getGenres())->not()->toBeEmpty();
    expect($movie->getGenres())->each(fn (Pest\Expectation $genre) => expect($genre->value)->toBeInstanceOf(TmdbGenre::class));

    expect($movie->getPosterPath())->toStartWith('/');
    expect($movie->getBackdropPath())->toStartWith('/');

    expect($movie->getHomepage())->toBeString();
    expect($movie->getId())->toBeInt();
    expect($movie->getImdbId())->toBeString();
    expect($movie->getOriginalLanguage())->toBeString();
    expect($movie->getOriginalTitle())->toBeString();
    expect($movie->getTitle())->toBeString();
    expect($movie->getOriginCountry())->toBeArray();
    expect($movie->getOverview())->toBeString();
    expect($movie->getTmdbUrl())->toBeString();
    expect($movie->getPopularity())->toBeFloat();
    expect($movie->getRuntime())->toBeInt();
    expect($movie->getTagline())->toBeString();
    expect($movie->getVoteAverage())->toBeFloat();
    expect($movie->getVoteCount())->toBeInt();
    expect($movie->getVotePercentage())->toBeFloat()->and($movie->getVotePercentage())->toBeGreaterThan(80);
    expect($movie->getVideos())->toBeNull();

    expect($movie->getReleaseDate())->toBeInstanceOf(DateTime::class);
    expect($movie->getRevenue())->toBeInt();
});

it('can get movie alternative titles', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120, ['alternative_titles']);

    expect($movie->getAlternativeTitles())->not()->toBeNull();
    expect($movie->getAlternativeTitle('FR'))->toBeInstanceOf(TmdbAlternativeTitle::class);
    expect($movie->getAlternativeTitle('US'))->toBeInstanceOf(TmdbAlternativeTitle::class);
});

it('can get movie posters', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120);

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
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120, ['release_dates']);

    expect($movie->getReleaseDates())->not()->toBeNull();
    $french = $movie->getReleaseDateSpecific('FR');
    expect($french)->toBeInstanceOf(TmdbReleaseDate::class);
    expect($french->getIso31661())->toBe('FR');
    expect($french->getReleaseDates())->toBeArray();
    expect($french->getFirstReleaseDate())->toBeInstanceOf(TmdbReleaseDateItem::class);
    expect($french->getSpecificReleaseDate('Blu-Ray'))->toBeInstanceOf(TmdbReleaseDateItem::class);
});

it('can get movie credits', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120, ['credits']);

    expect($movie->getCredits())->not()->toBeNull();

    $cast = $movie->getCredits()->getCast();
    expect($cast)->toBeArray();
    expect($cast)->not()->toBeEmpty();
    expect($cast)->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(TmdbCast::class));
    $first = reset($cast);
    expect($first->getId())->toBeInt();
    expect($first->getCharacter())->toBeString();
    expect($first->getName())->toBeString();
    expect($first->getOrder())->toBeInt();
    expect($first->getProfilePath())->toBeString();
    expect($first->getTmdbUrl())->toBeString();
    expect($first->isAdult())->toBeBool();

    $crew = $movie->getCredits()->getCrew();
    expect($crew)->toBeArray();
    expect($crew)->not()->toBeEmpty();
    expect($crew)->each(fn (Pest\Expectation $crew) => expect($crew->value)->toBeInstanceOf(TmdbCrew::class));
    $first = reset($crew);
    expect($first->getId())->toBeInt();
    expect($first->getDepartment())->toBeString();
    expect($first->getJob())->toBeString();
    expect($first->getName())->toBeString();
    expect($first->getProfilePath())->toBeString();
    expect($first->getTmdbUrl())->toBeString();
    expect($first->isAdult())->toBeBool();
});

it('can get movie spoken languages', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120);

    expect($movie->getSpokenLanguages())->not()->toBeNull();
    expect($movie->getSpokenLanguages())->toBeArray();
    expect($movie->getSpokenLanguages())->not()->toBeEmpty();
    expect($movie->getSpokenLanguages())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(TmdbSpokenLanguage::class));
});

it('can get movie recommendations', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120, ['recommendations']);
    $recommendations = $movie->getRecommendations();

    expect($recommendations)->not()->toBeNull();
    expect($recommendations->getResults())->toBeArray();
    expect($recommendations->getResults())->not()->toBeEmpty();
    expect($recommendations->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(TmdbMovie::class));
});

it('can get movie similar', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120, ['similar']);

    $similar = $movie->getSimilar();

    expect($similar)->not()->toBeNull();
    expect($similar->getResults())->toBeArray();
    expect($similar->getResults())->not()->toBeEmpty();
    expect($similar->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(TmdbMovie::class));
});

it('can get movie videos', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120, ['videos']);
    $videos = $movie->getVideos();

    expect($videos)->not()->toBeNull();
    expect($videos)->toBeArray();
    expect($videos)->not()->toBeEmpty();
    expect($videos)->each(fn (Pest\Expectation $video) => expect($video->value)->toBeInstanceOf(TmdbVideo::class));

    $first = reset($videos);
    expect($first->getId())->toBeString();
    expect($first->getIso6391())->toBeString();
    expect($first->getIso31661())->toBeString();
    expect($first->getKey())->toBeString();
    expect($first->getName())->toBeString();
    expect($first->getSite())->toBeString();
    expect($first->getSize())->toBeInt();
    expect($first->getType())->toBeString();
    expect($first->isOfficial())->toBeBool();
    expect($first->getPublishedAt())->toBeInstanceOf(DateTime::class);
    expect($first->getYouTubeUrl())->toBeString();
});

it('can get null if movie not exists (tmdb id)', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(50000000);

    expect($movie)->toBeNull();
});

it('can get movie companies', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120);

    $companies = $movie->getProductionCompanies();
    expect($companies)->toBeArray();
    expect($companies)->not()->toBeEmpty();
    expect($companies)->each(fn (Pest\Expectation $company) => expect($company->value)->toBeInstanceOf(TmdbCompany::class));

    $first = reset($companies);
    expect($first->getId())->toBe(12);
    expect($first->getLogoPath())->toBeString();
    expect($first->getName())->toBe('New Line Cinema');
    expect($first->getOriginCountry())->toBe('US');
});

it('can get movie countries', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120);

    $countries = $movie->getProductionCountries();
    expect($countries)->toBeArray();
    expect($countries)->not()->toBeEmpty();
    expect($countries)->each(fn (Pest\Expectation $country) => expect($country->value)->toBeInstanceOf(TmdbCountry::class));

    $first = reset($countries);
    expect($first->getIso31661())->toBe('NZ');
    expect($first->getName())->toBeString('New Zealand');
});

it('can get directors', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120, ['credits']);

    $directors = $movie->getDirectors();
    expect(reset($directors)?->getName())->toBe('Peter Jackson');
});

it('can get belongs to', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120);

    expect($movie->getBelongsToCollection())->toBeInstanceOf(TmdbCollection::class);
    expect($movie->getCollection())->toBeInstanceOf(TmdbCollection::class);
    expect($movie->getCollection()->getId())->toBe(119);
    expect($movie->getCollection()->getName())->toBe('The Lord of the Rings Collection');
    expect($movie->getCollection()->getPosterPath())->toBeString();
    expect($movie->getCollection()->getBackdropPath())->toBeString();
    expect($movie->getCollection()->getTmdbUrl())->toBeString();
});

it('can raw data', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120);

    expect($movie->getRawData())->not()->toBeNull();
    expect($movie->getRawData())->toBeArray();
});

it('can update properties', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(120);

    expect($movie->getTitle())->toBe('The Lord of the Rings: The Fellowship of the Ring');
    $movie->__set('title', 'The Lord of the Rings: The Two Towers');
    expect($movie->getTitle())->toBe('The Lord of the Rings: The Two Towers');
});
