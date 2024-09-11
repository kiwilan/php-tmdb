<?php

use Kiwilan\Tmdb\Models\Credits\Cast;
use Kiwilan\Tmdb\Models\Credits\Crew;
use Kiwilan\Tmdb\Models\TvSeries\Episode;
use Kiwilan\Tmdb\Tmdb;

it('can find episode', function () {
    $episode = Tmdb::client(apiKey())->getEpisode(1399, 1, 1);

    expect($episode)->not()->toBeNull();
    expect($episode)->toBeInstanceOf(Episode::class);
    expect($episode->getAirDate())->toBeInstanceOf(DateTime::class);

    expect($episode->getCast())->toBeArray();
    expect($episode->getCast())->not()->toBeEmpty();
    expect($episode->getCast())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(Cast::class));

    expect($episode->getCrew())->toBeArray();
    expect($episode->getCrew())->not()->toBeEmpty();
    expect($episode->getCrew())->each(fn (Pest\Expectation $crew) => expect($crew->value)->toBeInstanceOf(Crew::class));

    expect($episode->getEpisodeNumber())->toBeInt();
    expect($episode->getName())->toBeString();
    expect($episode->getOverview())->toBeString();
    expect($episode->getProductionCode())->toBeString();
    expect($episode->getRuntime())->toBeInt();
    expect($episode->getSeasonNumber())->toBeInt();
    expect($episode->getVoteAverage())->toBeFloat();
    expect($episode->getVoteCount())->toBeInt();
    expect($episode->getId())->toBeInt();
    expect($episode->getStillPath())->toBeString();
});
