<?php

use Kiwilan\Tmdb\Models\Credits;
use Kiwilan\Tmdb\Models\Credits\Cast;
use Kiwilan\Tmdb\Models\Credits\Crew;
use Kiwilan\Tmdb\Models\TvSeries\Episode;
use Kiwilan\Tmdb\Models\TvSeries\Season;
use Kiwilan\Tmdb\Tmdb;

it('can find season', function () {
    $season = Tmdb::client(apiKey())
        ->tvSeasons()
        ->details(1399, 1);

    expect($season)->not()->toBeNull();
    expect($season)->toBeInstanceOf(Season::class);
    expect($season->getAirDate())->toBeInstanceOf(DateTime::class);

    expect($season->getEpisodes())->toBeArray();
    expect($season->getEpisodes())->not()->toBeEmpty();
    expect($season->getEpisodes())->each(fn (Pest\Expectation $episode) => expect($episode->value)->toBeInstanceOf(Episode::class));

    expect($season->getName())->toBeString();
    expect($season->getOverview())->toBeString();
    expect($season->getSeasonNumber())->toBeInt();
    expect($season->getVoteAverage())->toBeFloat();
    expect($season->getCredits())->toBeInstanceOf(Credits::class);
    expect($season->getId())->toBeInt();
    expect($season->getPosterPath())->toBeString();
});

it('can find season credits', function () {
    $season = Tmdb::client(apiKey())
        ->tvSeasons()
        ->details(1399, 1, ['credits']);

    expect($season->getCredits())->toBeInstanceOf(Credits::class);
    expect($season->getCredits()->getCast())->toBeArray();
    expect($season->getCredits()->getCast())->not()->toBeEmpty();
    expect($season->getCredits()->getCast())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(Cast::class));

    expect($season->getCredits()->getCrew())->toBeArray();
    expect($season->getCredits()->getCrew())->not()->toBeEmpty();
    expect($season->getCredits()->getCrew())->each(fn (Pest\Expectation $crew) => expect($crew->value)->toBeInstanceOf(Crew::class));
});
