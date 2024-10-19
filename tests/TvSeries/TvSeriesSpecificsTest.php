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

it('can get The Legend Of Vox Machina', function () {
    $tv = Tmdb::client(apiKey())
        ->search()
        ->tv('The Legend Of Vox Machina');
    $first = $tv->getFirstResult();

    expect($first)->not()->toBeNull();
    expect($first)->toBeInstanceOf(\Kiwilan\Tmdb\Models\TmdbTvSeries::class);
    expect($first->getName())->toBe('The Legend of Vox Machina');
    expect($first->getId())->toBe(135934);
    expect($first->getOriginalLanguage())->toBe('en');
});
