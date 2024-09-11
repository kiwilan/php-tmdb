<?php

use Kiwilan\Tmdb\Models\Collection;
use Kiwilan\Tmdb\Models\Movie;
use Kiwilan\Tmdb\Tmdb;

it('can get collection', function () {
    $collection = Tmdb::client(apiKey())->getCollection(119);

    expect($collection)->toBeInstanceOf(Collection::class);
    expect($collection->getId())->toBe(119);
    expect($collection->getName())->toBe('The Lord of the Rings Collection');
    expect($collection->getPosterPath())->toBeString();
    expect($collection->getBackdropPath())->toBeString();
    expect($collection->getOverview())->toBeString();
    expect($collection->getParts())->toBeArray();
    expect($collection->getParts())->not()->toBeEmpty();
    expect($collection->getParts())->each(fn (Pest\Expectation $part) => expect($part->value)->toBeInstanceOf(Movie::class));
});
