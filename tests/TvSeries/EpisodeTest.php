<?php

use Kiwilan\Tmdb\Models\Credits\Cast;
use Kiwilan\Tmdb\Models\Credits\Crew;
use Kiwilan\Tmdb\Models\TvSeries\Episode;
use Kiwilan\Tmdb\Tmdb;

it('can find episode', function () {
    $episode = Tmdb::client(apiKey())
        ->tvEpisodes()
        ->details(1399, 1, 1);

    expect($episode)->not()->toBeNull();
    expect($episode)->toBeInstanceOf(Episode::class);
    expect($episode->getAirDate())->toBeInstanceOf(DateTime::class);

    expect($episode->getCredits()->getCast())->toBeArray();
    expect($episode->getCredits()->getCast())->not()->toBeEmpty();
    expect($episode->getCredits()->getCast())->each(fn (Pest\Expectation $cast) => expect($cast->value)->toBeInstanceOf(Cast::class));

    expect($episode->getCredits()->getCrew())->toBeArray();
    expect($episode->getCredits()->getCrew())->not()->toBeEmpty();
    expect($episode->getCredits()->getCrew())->each(fn (Pest\Expectation $crew) => expect($crew->value)->toBeInstanceOf(Crew::class));

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
    expect($episode->getStillUrl())->toBeString();
    expect($episode->getStillImage())->toBeString();

    $path = mediaPath('/still-original.jpg');
    expect($episode->saveStillImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
});
