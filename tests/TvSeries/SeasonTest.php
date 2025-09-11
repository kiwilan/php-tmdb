<?php

use Kiwilan\Tmdb\Models\Common\TmdbExternalIds;
use Kiwilan\Tmdb\Models\Common\TmdbVideo;
use Kiwilan\Tmdb\Models\Credits\TmdbCast;
use Kiwilan\Tmdb\Models\Credits\TmdbCrew;
use Kiwilan\Tmdb\Models\TmdbCredits;
use Kiwilan\Tmdb\Models\Translations\TmdbTranslation;
use Kiwilan\Tmdb\Models\TvSeries\TmdbEpisode;
use Kiwilan\Tmdb\Models\TvSeries\TmdbSeason;
use Kiwilan\Tmdb\Tmdb;

it('can find season', function () {
    $season = Tmdb::client(apiKey())
        ->tvSeasons()
        ->details(1399, 1);

    expect($season)->not()->toBeNull();
    expect($season)->toBeInstanceOf(TmdbSeason::class);
    expect($season->getAirDate())->toBeInstanceOf(DateTime::class);

    expect($season->getEpisodes())->toBeArray();
    expect($season->getEpisodes())->not()->toBeEmpty();
    expect($season->getEpisodes())->each(fn (Pest\Expectation $episode) => expect($episode->value)->toBeInstanceOf(TmdbEpisode::class));

    $first = $season->getEpisodes()[0];
    expect($first)->toBeInstanceOf(TmdbEpisode::class);
    expect($first->getTmdbUrl())->toBeString();

    expect($season->getName())->toBeString();
    expect($season->getOverview())->toBeString();
    expect($season->getSeasonNumber())->toBeInt();
    expect($season->getEpisodesCount())->toBeInt();
    expect($season->getVoteAverage())->toBeFloat();
    expect($season->getCredits())->toBeNull();
    expect($season->getId())->toBeInt();
    expect($season->getPosterPath())->toBeString();
    expect($season->getVotePercentage())->toBeFloat()->and($season->getVotePercentage())->toBeGreaterThan(80);
    expect($season->getTmdbUrl())->toBeString();
});

it('can find season credits', function () {
    $season = Tmdb::client(apiKey())
        ->tvSeasons()
        ->details(1399, 1, ['credits']);

    expect($season->getCredits())->toBeInstanceOf(TmdbCredits::class);
    expect($season->getCredits()->getCast())->toBeArray();
    expect($season->getCredits()->getCast())->not()->toBeEmpty();
    expect($season->getCredits()->getCast())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(TmdbCast::class));

    expect($season->getCredits()->getCrew())->toBeArray();
    expect($season->getCredits()->getCrew())->not()->toBeEmpty();
    expect($season->getCredits()->getCrew())->each(fn (Pest\Expectation $crew) => expect($crew->value)->toBeInstanceOf(TmdbCrew::class));
});

it('can get translations', function () {
    $season = Tmdb::client(apiKey())
        ->tvSeasons()
        ->details(1399, 1, ['translations']);

    $french = $season->getTranslation('FR');
    expect(count($season->getTranslations()))->toBeGreaterThan(50);

    expect($french)->toBeInstanceOf(TmdbTranslation::class);
    expect($french->getEnglishName())->toBe('French');
    expect($french->getIso639())->toBe('fr');
    expect($french->getName())->toBe('Français');

    expect($french->getData())->toBeArray();
    expect($french->getDataKey('name'))->toBeString();
    expect($french->getDataKey('overview'))->toBeString();
});

it('can get videos', function () {
    $season = Tmdb::client(apiKey())
        ->tvSeasons()
        ->details(1399, 1, ['videos']);
    expect($season->getVideos())->toBeArray();

    $teaser = $season->getVideoTeaser();
    expect($teaser)->toBeInstanceOf(TmdbVideo::class);
    expect($teaser->getType())->toBe('Teaser');
    expect($teaser)->not()->toBeNull();
    expect($teaser->getYouTubeUrl())->toBeString();
});

it('can get external ids 39340', function () {
    $season = Tmdb::client(apiKey())
        ->tvSeasons()
        ->details(series_id: 39340, season_number: 1, append_to_response: ['external_ids']);

    $external_ids = $season->getExternalIds();
    expect($external_ids)->toBeInstanceOf(TmdbExternalIds::class);
    expect($external_ids->getImdbId())->toBeNull();
    expect($external_ids->getFreebaseMid())->toBeString();
    expect($external_ids->getFreebaseMid())->toBe('/m/0k6_6_s');
    expect($external_ids->getFreebaseId())->toBeNull();
    expect($external_ids->getTvdbId())->toBeInt();
    expect($external_ids->getTvdbId())->toBe(465948);
    expect($external_ids->getTvrageId())->toBeNull();
    expect($external_ids->getWikidataId())->toBeNull();
    expect($external_ids->getFacebookId())->toBeNull();
    expect($external_ids->getInstagramId())->toBeNull();
    expect($external_ids->getTwitterId())->toBeNull();
});
