<?php

use Kiwilan\Tmdb\Models\Credits\TmdbCast;
use Kiwilan\Tmdb\Models\Credits\TmdbCrew;
use Kiwilan\Tmdb\Models\TmdbCredits;
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
