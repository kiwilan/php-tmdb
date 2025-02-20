<?php

use Kiwilan\Tmdb\Enums\TmdbImageType;
use Kiwilan\Tmdb\Models\Images\TmdbImage;
use Kiwilan\Tmdb\Models\Images\TmdbImages;
use Kiwilan\Tmdb\Models\TmdbCollection;
use Kiwilan\Tmdb\Models\TmdbMovie;
use Kiwilan\Tmdb\Models\Translations\TmdbTranslation;
use Kiwilan\Tmdb\Models\Translations\TmdbTranslations;
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
    expect($results->getFirstResult())->toBeInstanceOf(TmdbCollection::class);
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

    expect($results->getResults())->toBeArray();
    expect($results->getResults())->not()->toBeEmpty();
    expect($results->getFirstResult())->toBeInstanceOf(TmdbCollection::class);
    expect($results->getResults())->each(fn (Pest\Expectation $collection) => expect($collection->value)->toBeInstanceOf(TmdbCollection::class));

    $collection = $results->filter(fn (TmdbCollection $collection) => $collection->getPosterPath() !== null);
    expect($collection)->toBeArray();
    expect($collection)->not()->toBeEmpty();
    expect($collection)->each(fn (Pest\Expectation $collection) => expect($collection->value)->toBeInstanceOf(TmdbCollection::class));

    $collection = $results->find(fn (TmdbCollection $collection) => $collection->getPosterPath() !== null);
    expect($collection)->toBeInstanceOf(TmdbCollection::class);

    expect($results->getFirstResult())->toBeInstanceOf(TmdbCollection::class);
    expect($results->getLastResult())->toBeInstanceOf(TmdbCollection::class);
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
    expect($results->getFirstResult())->toBeInstanceOf(TmdbCollection::class);
    expect($results->getFirstResult()->getName())->toBe('Le Seigneur des anneaux - Saga');
});

it('can get collection details', function () {
    $collection = Tmdb::client(apiKey())
        ->collections()
        ->details(collection_id: 119);

    expect($collection)->not()->toBeNull();
    expect($collection)->toBeInstanceOf(TmdbCollection::class);
    expect($collection->getId())->toBe(119);
    expect($collection->getName())->toBe('The Lord of the Rings Collection');
    expect($collection->getOverview())->toBeString();
    expect($collection->getBackdropPath())->toBeString();
    expect($collection->getPosterPath())->toBeString();
    expect($collection->getTmdbUrl())->toBeString();

    expect($collection->getParts())->toBeArray();
    expect($collection->getParts())->not()->toBeEmpty();
    expect($collection->getParts())->each(fn (Pest\Expectation $part) => expect($part->value)->toBeInstanceOf(TmdbMovie::class));
});

it('can get collection images', function () {
    $images = Tmdb::client(apiKey())
        ->collections()
        ->images(collection_id: 119);

    expect($images)->not()->toBeNull();
    expect($images)->toBeInstanceOf(TmdbImages::class);
    expect($images->getBackdrops())->toBeArray();
    expect($images->getId())->toBeInt();

    $backdrops = $images->getBackdrops();
    expect($backdrops)->toBeArray();
    expect($backdrops)->not()->toBeEmpty();
    expect($backdrops)->each(fn (Pest\Expectation $backdrop) => expect($backdrop->value)->toBeInstanceOf(TmdbImage::class));

    $first = $backdrops[0];
    expect($first->getAspectRatio())->toBeFloat();
    expect($first->getHeight())->toBeInt();
    if ($first->getIso639()) {
        expect($first->getIso639())->toBeString();
    }
    expect($first->getFilePath())->toBeString();
    expect($first->getVoteAverage())->toBeFloat();
    expect($first->getVoteCount())->toBeInt();
    expect($first->getWidth())->toBeInt();
    expect($first->getType())->toBe(TmdbImageType::BACKDROP);

    $posters = $images->getPosters();
    expect($posters)->toBeArray();
    expect($posters)->not()->toBeEmpty();
    expect($posters)->each(fn (Pest\Expectation $poster) => expect($poster->value)->toBeInstanceOf(TmdbImage::class));

    $first = $posters[0];
    expect($first->getAspectRatio())->toBeFloat();
    expect($first->getHeight())->toBeInt();
    if ($first->getIso639()) {
        expect($first->getIso639())->toBeString();
    }
    expect($first->getFilePath())->toBeString();
    expect($first->getVoteAverage())->toBeFloat();
    expect($first->getVoteCount())->toBeInt();
    expect($first->getWidth())->toBeInt();
    expect($first->getType())->toBe(TmdbImageType::POSTER);
});

it('can get collection translations', function () {
    $translations = Tmdb::client(apiKey())
        ->collections()
        ->translations(collection_id: 119);

    expect($translations)->not()->toBeNull();
    expect($translations)->toBeInstanceOf(TmdbTranslations::class);
    expect($translations->getId())->toBe(119);

    $translations = $translations->getTranslations();
    expect($translations)->toBeArray();
    expect($translations)->not()->toBeEmpty();
    expect($translations)->each(fn (Pest\Expectation $translation) => expect($translation->value)->toBeInstanceOf(TmdbTranslation::class));

    $first = $translations[0];
    expect($first->getIso3166())->toBeString();
    expect($first->getIso639())->toBeString();
    expect($first->getName())->toBeString();
    expect($first->getEnglishName())->toBeString();
    expect($first->getData())->toBeArray();
});
