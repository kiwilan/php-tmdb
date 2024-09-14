<?php

use Kiwilan\Tmdb\Models\Collection;
use Kiwilan\Tmdb\Models\Movie;
use Kiwilan\Tmdb\Query\SearchCollectionQuery;
use Kiwilan\Tmdb\Results\CollectionResults;
use Kiwilan\Tmdb\Tmdb;

it('can get collection', function () {
    $results = Tmdb::client(apiKey())
        ->search()
        ->collection(query: 'the lord of the rings');

    expect($results)->not()->toBeNull();
    expect($results)->toBeInstanceOf(CollectionResults::class);
    expect($results->getResults())->toBeArray();
    expect($results->getResults())->not()->toBeEmpty();
    expect($results->getFirstResult())->toBeInstanceOf(Collection::class);
    expect($results->getTotalPages())->toBeInt();
    expect($results->getTotalResults())->toBeInt();
    expect($results->getPage())->toBeInt();

    $first = $results->getFirstResult();
    expect($first->getId())->toBe(1173608);
    expect($first->getName())->toBe('The Making of The Lord of the Rings Collection');
    expect($first->getOriginalLanguage())->toBe('en');
    expect($first->getOriginalName())->toBe('The Making of The Lord of the Rings Collection');
    expect($first->getOverview())->toBeString();
    expect($first->getPosterPath())->toBeString();
    expect($first->getBackdropPath())->toBeNull();
    expect($first->isAdult())->toBeFalse();
});

it('can search collection with options', function () {
    $results = Tmdb::client(apiKey())
        ->search()
        ->collection('le seigneur des anneaux', new SearchCollectionQuery(
            include_adult: true,
            language: 'fr-FR',
            page: 1,
            year: 2001,
        ));

    expect($results)->not()->toBeNull();
    expect($results)->toBeInstanceOf(CollectionResults::class);
    expect($results->getResults())->toBeArray();
    expect($results->getResults())->not()->toBeEmpty();
    expect($results->getFirstResult())->toBeInstanceOf(Collection::class);
    expect($results->getFirstResult()->getName())->toBe('Le Seigneur des anneaux - Saga');
});

it('can get collection details', function () {
    $collection = Tmdb::client(apiKey())
        ->collections()
        ->details(collection_id: 119);

    expect($collection)->not()->toBeNull();
    expect($collection)->toBeInstanceOf(Collection::class);
    expect($collection->getId())->toBe(119);
    expect($collection->getName())->toBe('The Lord of the Rings Collection');
    expect($collection->getOverview())->toBeString();
    expect($collection->getBackdropPath())->toBeString();
    expect($collection->getPosterPath())->toBeString();
    expect($collection->getTmdbUrl())->toBeString();

    expect($collection->getParts())->toBeArray();
    expect($collection->getParts())->not()->toBeEmpty();
    expect($collection->getParts())->each(fn (Pest\Expectation $part) => expect($part->value)->toBeInstanceOf(Movie::class));
});
