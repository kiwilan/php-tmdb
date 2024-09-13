<?php

use Kiwilan\Tmdb\Models\Credit;
use Kiwilan\Tmdb\Models\TvSeries\Episode;
use Kiwilan\Tmdb\Models\TvSeries\Season;
use Kiwilan\Tmdb\Tmdb;

it('can get credits crew', function () {
    $credit = Tmdb::client(apiKey())
        ->credits()
        ->details('5256c8b219c2956ff6047cd8');

    expect($credit)->not()->toBeNull();
    expect($credit)->toBeInstanceOf(Credit::class);

    expect($credit->getCreditType())->toBe('cast');
    expect($credit->getDepartment())->toBe('Acting');
    expect($credit->getJob())->toBe('Actor');
    expect($credit->getMedia())->toBeInstanceOf(\Kiwilan\Tmdb\Models\Credits\CreditMedia::class);
    expect($credit->getMediaType())->toBe('tv');
    expect($credit->getId())->toBe('5256c8b219c2956ff6047cd8');
    expect($credit->getPerson())->toBeInstanceOf(\Kiwilan\Tmdb\Models\Credits\Person::class);

    expect($credit->getMedia()->getName())->toBe('Game of Thrones');
    expect($credit->getMedia()->getOriginalName())->toBe('Game of Thrones');
    expect($credit->getMedia()->getOverview())->toBeString();
    expect($credit->getMedia()->getMediaType())->toBe('tv');
    expect($credit->getMedia()->isAdult())->toBeFalse();
    expect($credit->getMedia()->getOriginalLanguage())->toBe('en');
    expect($credit->getMedia()->getGenreIds())->toBeArray();
    expect($credit->getMedia()->getPopularity())->toBeFloat();
    expect($credit->getMedia()->getFirstAirDate())->toBeInstanceOf(DateTime::class);
    expect($credit->getMedia()->getVoteAverage())->toBeFloat();
    expect($credit->getMedia()->getVoteCount())->toBeInt();
    expect($credit->getMedia()->getOriginCountry())->toBeArray();
    expect($credit->getMedia()->getCharacter())->toBeString();

    expect($credit->getMedia()->getEpisodes())->toBeArray();
    expect($credit->getMedia()->getSeasons())->not()->toBeEmpty();
    expect($credit->getMedia()->getEpisodes())->each(fn (Pest\Expectation $episode) => expect($episode->value)->toBeInstanceOf(Episode::class));

    expect($credit->getMedia()->getSeasons())->toBeArray();
    expect($credit->getMedia()->getSeasons())->not()->toBeEmpty();
    expect($credit->getMedia()->getSeasons())->each(fn (Pest\Expectation $season) => expect($season->value)->toBeInstanceOf(Season::class));
});

it('can get credits cast', function () {
    $credit = Tmdb::client(apiKey())
        ->credits()
        ->details('52fe421ac3a36847f800448f');

    expect($credit)->not()->toBeNull();
    expect($credit)->toBeInstanceOf(Credit::class);

    expect($credit->getCreditType())->toBe('cast');
    expect($credit->getDepartment())->toBe('Acting');
    expect($credit->getJob())->toBe('Actor');
    expect($credit->getMedia())->toBeInstanceOf(\Kiwilan\Tmdb\Models\Credits\CreditMedia::class);
    expect($credit->getMediaType())->toBe('movie');
    expect($credit->getId())->toBe('52fe421ac3a36847f800448f');
    expect($credit->getPerson())->toBeInstanceOf(\Kiwilan\Tmdb\Models\Credits\Person::class);

    // #adult: false
    // #gender: 2
    // #known_for_department: "Acting"
    // #name: "Elijah Wood"
    // #original_name: "Elijah Wood"
    // #popularity: 28.82
    // #profile_path: "/7UKRbJBNG7mxBl2QQc5XsAh6F8B.jpg"
    // #credit_id: null
    // #id: 109

    expect($credit->getPerson()->isAdult())->toBeFalse();
    expect($credit->getPerson()->getGender())->toBe(2);
    expect($credit->getPerson()->getKnownForDepartment())->toBe('Acting');
    expect($credit->getPerson()->getName())->toBe('Elijah Wood');
    expect($credit->getPerson()->getOriginalName())->toBe('Elijah Wood');
    expect($credit->getPerson()->getPopularity())->toBeFloat();
    expect($credit->getPerson()->getCreditId())->toBeNull();
    expect($credit->getPerson()->getId())->toBe(109);

    expect($credit->getPerson()->getProfilePath())->toBeString();
    expect($credit->getPerson()->getProfileUrl())->toStartWith('https://');
    expect($credit->getPerson()->getProfileImage())->toBeString();

    clearMedia();

    $path = mediaPath('/profile-original.jpg');
    expect($credit->getPerson()->saveProfileImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();

    ray($credit->getPerson())->purple();
});
