<?php

use Kiwilan\Tmdb\Tmdb;

it('can get cats', function () {
    $movie = Tmdb::client(apiKey())
        ->movies()
        ->details(536869, ['credits']);

    $directors = $movie->getDirectors();
    expect($directors)->toBeArray();
    expect($directors)->not->toBeEmpty();
    expect($directors[0]->getJob())->toBe('Director');
});
