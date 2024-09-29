<?php

use Kiwilan\Tmdb\Models\Credits\TmdbPerson;
use Kiwilan\Tmdb\Tmdb;

it('can get Attack on Titan', function () {
    $tv = Tmdb::client(apiKey())
        ->tvSeries()
        ->details(1429, ['credits', 'recommendations']);

    expect($tv)->not()->toBeNull();
    expect($tv)->toBeInstanceOf(\Kiwilan\Tmdb\Models\TmdbTvSeries::class);

    $crew = $tv->getCredits()->getCrew();
    $toshihiroMaeda = array_filter($crew, fn (TmdbPerson $crew) => $crew->getName() === 'Toshihiro Maeda');
    $toshihiroMaeda = array_shift($toshihiroMaeda);

    $contents = $toshihiroMaeda->getProfileImage();
    expect($contents)->not()->toBeNull();
    expect($contents)->toBeString();
});
