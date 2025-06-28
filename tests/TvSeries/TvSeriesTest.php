<?php

use Kiwilan\Tmdb\Models\Common\TmdbAlternativeTitle;
use Kiwilan\Tmdb\Models\Common\TmdbCompany;
use Kiwilan\Tmdb\Models\Common\TmdbCountry;
use Kiwilan\Tmdb\Models\Common\TmdbGenre;
use Kiwilan\Tmdb\Models\Common\TmdbSpokenLanguage;
use Kiwilan\Tmdb\Models\Common\TmdbVideo;
use Kiwilan\Tmdb\Models\Credits\TmdbCast;
use Kiwilan\Tmdb\Models\Credits\TmdbCrew;
use Kiwilan\Tmdb\Models\TmdbTvSeries;
use Kiwilan\Tmdb\Models\Translations\TmdbTranslation;
use Kiwilan\Tmdb\Models\TvSeries\TmdbContentRating;
use Kiwilan\Tmdb\Models\TvSeries\TmdbEpisode;
use Kiwilan\Tmdb\Models\TvSeries\TmdbNetwork;
use Kiwilan\Tmdb\Models\TvSeries\TmdbSeason;
use Kiwilan\Tmdb\Results\TvSerieResults;
use Kiwilan\Tmdb\Tmdb;

it('can get tv series details', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399);

    expect($tv)->not()->toBeNull();
    expect($tv)->toBeInstanceOf(\Kiwilan\Tmdb\Models\TmdbTvSeries::class);

    expect($tv->isAdult())->toBeFalse();
    expect($tv->getBackdropPath())->toBeString();

    expect($tv->getCreatedBy())->toBeArray();
    expect($tv->getCreatedBy())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(TmdbCrew::class));

    expect($tv->getEpisodeRunTime())->toBeNull();
    expect($tv->getFirstAirDate())->toBeInstanceOf(DateTime::class);

    expect($tv->getGenres())->toBeArray();
    expect($tv->getGenres())->not()->toBeEmpty();
    expect($tv->getGenres())->each(fn (Pest\Expectation $genre) => expect($genre->value)->toBeInstanceOf(TmdbGenre::class));

    expect($tv->getHomepage())->toBeString();
    expect($tv->getId())->toBeInt();
    expect($tv->inProduction())->toBeBool();

    expect($tv->getLanguages())->toBeArray();
    expect($tv->getLanguages())->not()->toBeEmpty();

    expect($tv->getLastAirDate())->toBeInstanceOf(DateTime::class);
    expect($tv->getLastEpisodeToAir())->toBeInstanceOf(TmdbEpisode::class);
    expect($tv->getName())->toBeString();

    expect($tv->getNetworks())->toBeArray();
    expect($tv->getNetworks())->not()->toBeEmpty();
    expect($tv->getNetworks())->each(fn (Pest\Expectation $network) => expect($network->value)->toBeInstanceOf(TmdbNetwork::class));

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
    expect($tv->getProductionCompanies())->each(fn (Pest\Expectation $company) => expect($company->value)->toBeInstanceOf(TmdbCompany::class));

    expect($tv->getProductionCountries())->toBeArray();
    expect($tv->getProductionCountries())->not()->toBeEmpty();
    expect($tv->getProductionCountries())->each(fn (Pest\Expectation $country) => expect($country->value)->toBeInstanceOf(TmdbCountry::class));

    expect($tv->getSeasons())->toBeArray();
    expect($tv->getSeasons())->not()->toBeEmpty();
    expect($tv->getSeasons())->each(fn (Pest\Expectation $season) => expect($season->value)->toBeInstanceOf(TmdbSeason::class));

    expect($tv->getSpokenLanguages())->toBeArray();
    expect($tv->getSpokenLanguages())->not()->toBeEmpty();
    expect($tv->getSpokenLanguages())->each(fn (Pest\Expectation $spokenLanguage) => expect($spokenLanguage->value)->toBeInstanceOf(TmdbSpokenLanguage::class));

    expect($tv->getStatus())->toBeString();
    expect($tv->getTagline())->toBeString();
    expect($tv->getType())->toBeString();
    expect($tv->getVoteAverage())->toBeFloat();
    expect($tv->getVoteCount())->toBeInt();
    expect($tv->getVotePercentage())->toBeFloat()->and($tv->getVotePercentage())->toBeGreaterThan(80);
    expect($tv->getTmdbUrl())->toBeString();
});

it('can parse alternative titles', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399, ['alternative_titles']);

    expect($tv->getAlternativeTitles())->toBeArray();
    expect($tv->getAlternativeTitles())->not()->toBeEmpty();
    expect($tv->getAlternativeTitles())->each(fn (Pest\Expectation $alternativeTitle) => expect($alternativeTitle->value)->toBeInstanceOf(TmdbAlternativeTitle::class));

    expect($tv->getAlternativeTitle('FR'))->toBeInstanceOf(TmdbAlternativeTitle::class);
    expect($tv->getAlternativeTitle('US'))->toBeInstanceOf(TmdbAlternativeTitle::class);
});

it('can parse content ratings', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399, ['content_ratings']);

    expect($tv->getContentRatings())->toBeArray();
    expect($tv->getContentRatings())->not()->toBeEmpty();
    expect($tv->getContentRatings())->each(fn (Pest\Expectation $contentRating) => expect($contentRating->value)->toBeInstanceOf(TmdbContentRating::class));

    $us = $tv->getContentRatingSpecific('US');
    expect($us)->toBeInstanceOf(TmdbContentRating::class);
    expect($us->getIso3166())->toBe('US');
    expect($us->getRating())->toBe('TV-MA');
});

it('can parse credits', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399, ['credits']);

    $credits = $tv->getCredits();
    expect($credits->getCast())->toBeArray();
    expect($credits->getCast())->not()->toBeEmpty();
    expect($credits->getCast())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(TmdbCast::class));

    expect($credits->getCrew())->toBeArray();
    expect($credits->getCrew())->not()->toBeEmpty();
    expect($credits->getCrew())->each(fn (Pest\Expectation $crew) => expect($crew->value)->toBeInstanceOf(TmdbCrew::class));

    expect($tv->getCreatedBy())->toBeArray();
    expect($tv->getCreatedBy())->not()->toBeEmpty();
    expect($tv->getCreatedBy())->each(fn (Pest\Expectation $creator) => expect($creator->value)->toBeInstanceOf(TmdbCrew::class));
});

it('can parse recommendations', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399, ['recommendations']);

    expect($tv->getRecommendations()->getResults())->toBeArray();
    expect($tv->getRecommendations())->not()->toBeEmpty();
    expect($tv->getRecommendations()->getResults())->each(fn (Pest\Expectation $recommendation) => expect($recommendation->value)->toBeInstanceOf(TmdbTvSeries::class));
});

it('can parse similar', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399, ['similar']);

    expect($tv->getSimilar()->getResults())->toBeArray();
    expect($tv->getSimilar()->getResults())->not()->toBeEmpty();
    expect($tv->getSimilar()->getResults())->each(fn (Pest\Expectation $similar) => expect($similar->value)->toBeInstanceOf(TmdbTvSeries::class));
});

it('can parse seasons', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399);

    $seasons = $tv->getSeasons();
    expect($seasons)->toBeArray();
    expect($seasons)->not()->toBeEmpty();
    expect($seasons)->each(fn (Pest\Expectation $similar) => expect($similar->value)->toBeInstanceOf(TmdbSeason::class));

    $second = $seasons[1];
    expect($second)->toBeInstanceOf(TmdbSeason::class);
    expect($second->getAirDate())->toBeInstanceOf(DateTime::class);
    expect($second->getName())->toBeString();
    expect($second->getOverview())->toBeString();
    expect($second->getSeasonNumber())->toBeInt();
    expect($second->getVoteAverage())->toBeFloat();
    expect($second->getId())->toBeInt();
    expect($second->getPosterPath())->toBeString();
    expect($second->getTmdbUrl())->toBeString();
});

it('can have null tv series results', function () {
    $results = new TvSerieResults(null);

    expect($results->getPage())->toBe(1);
    expect($results->getTotalPages())->toBe(1);
    expect($results->getTotalResults())->toBe(0);
    expect($results->getResults())->toBeArray();
});

it('can get translations', function () {
    $tvShow = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1399, ['translations']);

    $french = $tvShow->getTranslation('FR');
    expect(count($tvShow->getTranslations()))->toBeGreaterThan(50);

    expect($french)->toBeInstanceOf(TmdbTranslation::class);
    expect($french->getEnglishName())->toBe('French');
    expect($french->getIso639())->toBe('fr');
    expect($french->getName())->toBe('Français');

    expect($french->getData())->toBeArray();
    expect($french->getDataKey('name'))->toBe('');
    expect($french->getDataKey('overview'))->toBeString();
    expect($french->getDataKey('tagline'))->toBe("L'hiver arrive.");
    expect($french->getDataKey('homepage'))->toBeString();
});

it('can get videos from 1399', function () {
    $tvSerie = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(series_id: 1399, append_to_response: ['videos']);
    expect($tvSerie->getVideos())->toBeArray();

    $teaser = $tvSerie->getVideoTeaser();
    expect($teaser)->toBeInstanceOf(TmdbVideo::class);
    expect($teaser->getType())->toBe('Teaser');
    expect($teaser)->not()->toBeNull();
    expect($teaser->getYouTubeUrl())->toBeString();
});
