<?php

use App\Facades\TmdbClient;
use Tmdb\Model\Person\CastMember;
use Tmdb\Model\Person\CrewMember;
use Tmdb\Model\Person\GuestStar;
use Tmdb\Model\Tv\Episode;
use Tmdb\Repository\TvEpisodeRepository;

it('can get crew', function () {
    $repository = new TvEpisodeRepository(TmdbClient::connect());
    /** @var Episode */
    $e = $repository->load(60948, 1, 1, [
        'append_to_response' => 'credits',
    ]);

    $crew = $e->getCredits()->getCrew()->toArray();

    /** @var CrewMember */
    $first = reset($crew);

    expect($first->getId())->toBe(84023);
    expect($first->getName())->toBe('Jeffrey Reiner');
    expect($first->getProfilePath())->toBe('/xw9cRZZ1AywlMGwLTfTRvu9j3v4.jpg');
    expect($first->getDepartment())->toBe('Directing');
    expect($first->getJob())->toBe('Director');
    expect($first->getCreditId())->toBe('54bf5dc1925141315a000eed');

    expect(TmdbClient::imageUrl($first->getProfilePath()))->toBe('https://image.tmdb.org/t/p/original/xw9cRZZ1AywlMGwLTfTRvu9j3v4.jpg');
    expect(TmdbClient::imageBinary($first->getProfilePath()))->toBeString();
});

it('can get cast', function () {
    $repository = new TvEpisodeRepository(TmdbClient::connect());
    /** @var Episode */
    $e = $repository->load(60948, 1, 1, [
        'append_to_response' => 'credits',
    ]);

    $cast = $e->getCredits()->getCast()->toArray();

    /** @var CastMember */
    $first = reset($cast);

    expect($first->getId())->toBe(11022);
    expect($first->getName())->toBe('Aaron Stanford');
    expect($first->getProfilePath())->toBeString();
    expect($first->getCharacter())->toBe('James Cole');
    expect($first->getOrder())->toBe(0);
    expect($first->getCastId())->toBeNull();
    expect($first->getCreditId())->toBe('53ae71390e0a26598c003eb2');

    expect(TmdbClient::imageUrl($first->getProfilePath()))->toBeString();
    expect(TmdbClient::imageBinary($first->getProfilePath()))->toBeString();
});

it('can get guest star', function () {
    $repository = new TvEpisodeRepository(TmdbClient::connect());
    /** @var Episode */
    $e = $repository->load(60948, 1, 1, [
        'append_to_response' => 'credits',
    ]);

    $guestStars = $e->getCredits()->getGuestStars()->toArray();

    /** @var GuestStar */
    $first = reset($guestStars);

    expect($first->getId())->toBe(4570);
    expect($first->getName())->toBe('Emily Hampshire');
    expect($first->getProfilePath())->toBe('/kXb6SAUOACHN9F3M4rkxF7BsJGN.jpg');
    expect($first->getCharacter())->toBe('Jennifer Goines');
    expect($first->getOrder())->toBe(4);
    expect($first->getCastId())->toBeNull();
    expect($first->getCreditId())->toBe('552e6794c3a3686be2002c43');

    expect(TmdbClient::imageUrl($first->getProfilePath()))->toBe('https://image.tmdb.org/t/p/original/kXb6SAUOACHN9F3M4rkxF7BsJGN.jpg');
    expect(TmdbClient::imageBinary($first->getProfilePath()))->toBeString();
});
