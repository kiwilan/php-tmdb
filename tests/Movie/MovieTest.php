<?php

use Kiwilan\Tmdb\Models\Movie;
use Kiwilan\Tmdb\Tmdb;

it('can get movie similar', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120, 'similar');
    // $similar = $movie->getSimilar();
    ray($movie);

    // expect($similar)->toBeNull();
    // expect($similar->getResults())->toBeArray();
    // expect($similar->getResults())->toBeEmpty();
    // expect($similar->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(Movie::class));
});
