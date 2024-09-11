<?php

use App\Facades\TmdbClient;

it('can fetch recommendations movie', function () {
    $movie = TmdbClient::findMovie('Riddick', 2013);

    $recommendations = TmdbClient::loadRecommendations($movie);
    expect($recommendations)->toBeArray();

    $first = reset($recommendations);
    expect($first)->toBeInstanceOf(\Tmdb\Model\Movie::class);
});

it('can fetch recommendations tv', function () {
    $tv = TmdbClient::findTvShow('House of the Dragon', 2022);

    $recommendations = TmdbClient::loadRecommendations($tv);
    expect($recommendations)->toBeArray();

    $first = reset($recommendations);
    expect($first)->toBeInstanceOf(\Tmdb\Model\Tv::class);
});
