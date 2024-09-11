<?php

use App\Facades\TmdbClient;

it('can get collection details with tmdb model', function () {
    $collection = TmdbClient::loadCollection(1570);

    expect($collection->getId())->toBe(1570);
    expect($collection->getName())->toBe('Die Hard Collection');
    expect($collection->getOverview())->toBeString();
    expect($collection->getPosterPath())->toStartWith('/');
    expect($collection->getBackdropPath())->toStartWith('/');

    $parts = TmdbClient::loadCollectionMovies($collection);
    expect($parts)->toBeArray();

    $first = $parts[0];
    expect($first)->toBeInstanceOf(\Tmdb\Model\Movie::class);
});
