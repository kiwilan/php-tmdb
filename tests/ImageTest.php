<?php

use Kiwilan\Tmdb\Enums\BackdropSize;
use Kiwilan\Tmdb\Enums\LogoSize;
use Kiwilan\Tmdb\Enums\PosterSize;
use Kiwilan\Tmdb\Enums\ProfileSize;
use Kiwilan\Tmdb\Enums\StillSize;
use Kiwilan\Tmdb\Utils\TmdbBackdrop;
use Kiwilan\Tmdb\Utils\TmdbLogo;
use Kiwilan\Tmdb\Utils\TmdbPoster;
use Kiwilan\Tmdb\Utils\TmdbProfile;
use Kiwilan\Tmdb\Utils\TmdbStill;

define('BACKDROP_PATH', '/x2RS3uTcsJJ9IfjNPcgDmukoEcQ.jpg');
define('LOGO_PATH', '/2ycs64eqV5rqKYHyQK0GVoKGvfX.png');
define('POSTER_PATH', '/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg');
define('PROFILE_PATH', '/i6OuPNi7Fj6iitYXjpmrP18VLdP.jpg');
define('STILL_PATH', '/9hGF3WUkBf7cSjMg0cdMDHJkByd.jpg');

it('can get backdrop', function (BackdropSize $size) {
    clearMedia();

    $backdrop = TmdbBackdrop::make(BACKDROP_PATH)->size($size);
    expect($backdrop->getUrl())->toBe('https://image.tmdb.org/t/p/'.$size->value.BACKDROP_PATH);
    expect($backdrop->getImage())->toBeString();
    $path = mediaPath('/backdrop-'.$size->value.'.jpg');
    expect($backdrop->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(BackdropSize::cases());

it('can get logo', function (LogoSize $size) {
    clearMedia();

    $logo = TmdbLogo::make(LOGO_PATH)->size($size);
    expect($logo->getUrl())->toBe('https://image.tmdb.org/t/p/'.$size->value.LOGO_PATH);
    expect($logo->getImage())->toBeString();
    $path = mediaPath('/logo-'.$size->value.'.jpg');
    expect($logo->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(LogoSize::cases());

it('can get poster', function (PosterSize $size) {
    clearMedia();

    $poster = TmdbPoster::make(POSTER_PATH)->size($size);
    expect($poster->getUrl())->toBe('https://image.tmdb.org/t/p/'.$size->value.POSTER_PATH);
    expect($poster->getImage())->toBeString();
    $path = mediaPath('/poster-'.$size->value.'.jpg');
    expect($poster->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(PosterSize::cases());

it('can get profile', function (ProfileSize $size) {
    clearMedia();

    $profile = TmdbProfile::make(PROFILE_PATH)->size($size);
    expect($profile->getUrl())->toBe('https://image.tmdb.org/t/p/'.$size->value.PROFILE_PATH);
    expect($profile->getImage())->toBeString();
    $path = mediaPath('/profile-'.$size->value.'.jpg');
    expect($profile->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(ProfileSize::cases());

it('can get still', function (StillSize $size) {
    clearMedia();

    $still = TmdbStill::make(STILL_PATH)->size($size);
    expect($still->getUrl())->toBe('https://image.tmdb.org/t/p/'.$size->value.STILL_PATH);
    expect($still->getImage())->toBeString();
    $path = mediaPath('/still-'.$size->value.'.jpg');
    expect($still->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(StillSize::cases());
