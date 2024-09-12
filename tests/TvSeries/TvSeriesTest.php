<?php

use Kiwilan\Tmdb\Models\Common\AlternativeTitle;
use Kiwilan\Tmdb\Models\Common\Company;
use Kiwilan\Tmdb\Models\Common\Country;
use Kiwilan\Tmdb\Models\Common\Genre;
use Kiwilan\Tmdb\Models\Common\SpokenLanguage;
use Kiwilan\Tmdb\Models\Credits\Cast;
use Kiwilan\Tmdb\Models\Credits\Crew;
use Kiwilan\Tmdb\Models\TvSeries;
use Kiwilan\Tmdb\Models\TvSeries\ContentRating;
use Kiwilan\Tmdb\Models\TvSeries\Episode;
use Kiwilan\Tmdb\Models\TvSeries\Network;
use Kiwilan\Tmdb\Models\TvSeries\Season;
use Kiwilan\Tmdb\Tmdb;

it('can get tv series details', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399);

    expect($tv)->not()->toBeNull();
    expect($tv)->toBeInstanceOf(\Kiwilan\Tmdb\Models\TvSeries::class);

    expect($tv->isAdult())->toBeFalse();
    expect($tv->getBackdropPath())->toBeString();

    expect($tv->getCreatedBy())->toBeArray();
    expect($tv->getCreatedBy())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(Crew::class));

    expect($tv->getEpisodeRunTime())->toBeNull();
    expect($tv->getFirstAirDate())->toBeInstanceOf(DateTime::class);

    expect($tv->getGenres())->toBeArray();
    expect($tv->getGenres())->not()->toBeEmpty();
    expect($tv->getGenres())->each(fn (Pest\Expectation $genre) => expect($genre->value)->toBeInstanceOf(Genre::class));

    expect($tv->getHomepage())->toBeString();
    expect($tv->getId())->toBeInt();
    expect($tv->inProduction())->toBeBool();

    expect($tv->getLanguages())->toBeArray();
    expect($tv->getLanguages())->not()->toBeEmpty();

    expect($tv->getLastAirDate())->toBeInstanceOf(DateTime::class);
    expect($tv->getLastEpisodeToAir())->toBeInstanceOf(Episode::class);
    expect($tv->getName())->toBeString();

    expect($tv->getNetworks())->toBeArray();
    expect($tv->getNetworks())->not()->toBeEmpty();
    expect($tv->getNetworks())->each(fn (Pest\Expectation $network) => expect($network->value)->toBeInstanceOf(Network::class));

    expect($tv->getNumberOfEpisodes())->toBeInt();
    expect($tv->getNumberOfSeasons())->toBeInt();
    expect($tv->getSeasonsCount())->toBeInt();
    expect($tv->getOriginCountry())->toBeArray();
    expect($tv->getOriginalLanguage())->toBeString();
    expect($tv->getOriginalName())->toBeString();
    expect($tv->getOverview())->toBeString();
    expect($tv->getPopularity())->toBeFloat();
    expect($tv->getPosterPath())->toBeString();

    expect($tv->getProductionCompanies())->toBeArray();
    expect($tv->getProductionCompanies())->not()->toBeEmpty();
    expect($tv->getProductionCompanies())->each(fn (Pest\Expectation $company) => expect($company->value)->toBeInstanceOf(Company::class));

    expect($tv->getProductionCountries())->toBeArray();
    expect($tv->getProductionCountries())->not()->toBeEmpty();
    expect($tv->getProductionCountries())->each(fn (Pest\Expectation $country) => expect($country->value)->toBeInstanceOf(Country::class));

    expect($tv->getSeasons())->toBeArray();
    expect($tv->getSeasons())->not()->toBeEmpty();
    expect($tv->getSeasons())->each(fn (Pest\Expectation $season) => expect($season->value)->toBeInstanceOf(Season::class));

    expect($tv->getSpokenLanguages())->toBeArray();
    expect($tv->getSpokenLanguages())->not()->toBeEmpty();
    expect($tv->getSpokenLanguages())->each(fn (Pest\Expectation $spokenLanguage) => expect($spokenLanguage->value)->toBeInstanceOf(SpokenLanguage::class));

    expect($tv->getStatus())->toBeString();
    expect($tv->getTagline())->toBeString();
    expect($tv->getType())->toBeString();
    expect($tv->getVoteAverage())->toBeFloat();
    expect($tv->getVoteCount())->toBeInt();
});

it('can parse alternative titles', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399, ['alternative_titles']);

    expect($tv->getAlternativeTitles())->toBeArray();
    expect($tv->getAlternativeTitles())->not()->toBeEmpty();
    expect($tv->getAlternativeTitles())->each(fn (Pest\Expectation $alternativeTitle) => expect($alternativeTitle->value)->toBeInstanceOf(AlternativeTitle::class));

    expect($tv->getAlternativeTitle('FR'))->toBeInstanceOf(AlternativeTitle::class);
    expect($tv->getAlternativeTitle('US'))->toBeInstanceOf(AlternativeTitle::class);
});

it('can parse content ratings', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399, ['content_ratings']);

    expect($tv->getContentRatings())->toBeArray();
    expect($tv->getContentRatings())->not()->toBeEmpty();
    expect($tv->getContentRatings())->each(fn (Pest\Expectation $contentRating) => expect($contentRating->value)->toBeInstanceOf(ContentRating::class));

    $us = $tv->getContentRatingSpecific('US');
    expect($us)->toBeInstanceOf(ContentRating::class);
    expect($us->getIso31661())->toBe('US');
    expect($us->getRating())->toBe('TV-MA');
});

it('can parse credits', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399, ['credits']);

    $credits = $tv->getCredits();
    expect($credits->getCast())->toBeArray();
    expect($credits->getCast())->not()->toBeEmpty();
    expect($credits->getCast())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(Cast::class));

    expect($credits->getCrew())->toBeArray();
    expect($credits->getCrew())->not()->toBeEmpty();
    expect($credits->getCrew())->each(fn (Pest\Expectation $crew) => expect($crew->value)->toBeInstanceOf(Crew::class));

    expect($tv->getCreatedBy())->toBeArray();
    expect($tv->getCreatedBy())->not()->toBeEmpty();
    expect($tv->getCreatedBy())->each(fn (Pest\Expectation $creator) => expect($creator->value)->toBeInstanceOf(Crew::class));
});

it('can parse recommendations', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399, ['recommendations']);

    expect($tv->getRecommendations()->getResults())->toBeArray();
    expect($tv->getRecommendations())->not()->toBeEmpty();
    expect($tv->getRecommendations()->getResults())->each(fn (Pest\Expectation $recommendation) => expect($recommendation->value)->toBeInstanceOf(TvSeries::class));
});

it('can parse similar', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399, ['similar']);

    expect($tv->getSimilar()->getResults())->toBeArray();
    expect($tv->getSimilar()->getResults())->not()->toBeEmpty();
    expect($tv->getSimilar()->getResults())->each(fn (Pest\Expectation $similar) => expect($similar->value)->toBeInstanceOf(TvSeries::class));
});
