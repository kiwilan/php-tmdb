<?php

use App\Facades\TmdbClient;

it('can fetch similar movie', function () {
    $movie = TmdbClient::findMovie('Riddick', 2013);

    $similars = TmdbClient::loadSimilars($movie);
    expect($similars)->toBeArray();

    $first = reset($similars);
    expect($first)->toBeInstanceOf(\Tmdb\Model\Movie::class);
});

it('can fetch similar tv', function () {
    $tv = TmdbClient::findTvShow('House of the Dragon', 2022);

    $similars = TmdbClient::loadSimilars($tv);
    expect($similars)->toBeArray();
});
