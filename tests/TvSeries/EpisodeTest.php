<?php

use Kiwilan\Tmdb\Models\Common\TmdbExternalIds;
use Kiwilan\Tmdb\Models\Credits\TmdbCast;
use Kiwilan\Tmdb\Models\Credits\TmdbCrew;
use Kiwilan\Tmdb\Models\Translations\TmdbTranslation;
use Kiwilan\Tmdb\Models\TvSeries\TmdbEpisode;
use Kiwilan\Tmdb\Tmdb;

it('can find episode', function () {
    $episode = Tmdb::client(apiKey())
        ->tvEpisodes()
        ->details(1399, 1, 1);

    expect($episode)->not()->toBeNull();
    expect($episode)->toBeInstanceOf(TmdbEpisode::class);
    expect($episode->getAirDate())->toBeInstanceOf(DateTime::class);

    expect($episode->getCredits()->getCast())->toBeArray();
    expect($episode->getCredits()->getCast())->not()->toBeEmpty();
    expect($episode->getCredits()->getCast())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(TmdbCast::class));

    expect($episode->getCredits()->getCrew())->toBeArray();
    expect($episode->getCredits()->getCrew())->not()->toBeEmpty();
    expect($episode->getCredits()->getCrew())->each(fn (Pest\Expectation $crew) => expect($crew->value)->toBeInstanceOf(TmdbCrew::class));

    expect($episode->getEpisodeNumber())->toBeInt();
    expect($episode->getName())->toBeString();
    expect($episode->getOverview())->toBeString();
    expect($episode->getProductionCode())->toBeString();
    expect($episode->getRuntime())->toBeInt();
    expect($episode->getSeasonNumber())->toBeInt();
    expect($episode->getVoteAverage())->toBeFloat();
    expect($episode->getVoteCount())->toBeInt();
    expect($episode->getId())->toBeInt();
    expect($episode->getVotePercentage())->toBeFloat()->and($episode->getVotePercentage())->toBeGreaterThan(70);
    expect($episode->getTmdbUrl())->toBeString();

    expect($episode->getStillPath())->toBeString();
    expect($episode->getStillUrl())->toBeString();
    expect($episode->getStillImage())->toBeString();

    $path = mediaPath('/still-original.jpg');
    expect($episode->saveStillImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
});

it('can get translations', function () {
    $episode = Tmdb::client(apiKey())
        ->tvEpisodes()
        ->details(1399, 1, 1, ['translations']);

    $french = $episode->getTranslation('FR');
    expect(count($episode->getTranslations()))->toBeGreaterThan(50);

    expect($french)->toBeInstanceOf(TmdbTranslation::class);
    expect($french->getEnglishName())->toBe('French');
    expect($french->getIso639())->toBe('fr');
    expect($french->getName())->toBe('Français');

    expect($french->getData())->toBeArray();
    expect($french->getDataKey('name'))->toBeString();
    expect($french->getDataKey('overview'))->toBeString();
});

it('can get videos', function () {
    $episode = Tmdb::client(apiKey())
        ->tvEpisodes()
        ->details(1399, 1, 1, ['videos']);

    expect($episode->getVideos())->not()->toBeNull();
});

it('can get external ids 39340', function () {
    $episode = Tmdb::client(apiKey())
        ->tvEpisodes()
        ->details(series_id: 39340, season_number: 1, episode_number: 1, append_to_response: ['external_ids']);

    $external_ids = $episode->getExternalIds();
    expect($external_ids)->toBeInstanceOf(TmdbExternalIds::class);
    expect($external_ids->getImdbId())->toBe('tt1980319');
    expect($external_ids->getTvdbId())->toBe(4099506);
    expect($external_ids->getFreebaseMid())->toBe('/m/0k6_726');
    expect($external_ids->getFreebaseId())->toBeNull();
    expect($external_ids->getTvrageId())->toBeNull();
    expect($external_ids->getWikidataId())->toBeNull();
    expect($external_ids->getFacebookId())->toBeNull();
    expect($external_ids->getInstagramId())->toBeNull();
    expect($external_ids->getTwitterId())->toBeNull();
});
