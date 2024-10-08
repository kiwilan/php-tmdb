<?php

use Kiwilan\Tmdb\Enums\TmdbBackdropSize;
use Kiwilan\Tmdb\Enums\TmdbLogoSize;
use Kiwilan\Tmdb\Enums\TmdbPosterSize;
use Kiwilan\Tmdb\Enums\TmdbProfileSize;
use Kiwilan\Tmdb\Enums\TmdbStillSize;
use Kiwilan\Tmdb\Utils\Images\TmdbBackdrop;
use Kiwilan\Tmdb\Utils\Images\TmdbLogo;
use Kiwilan\Tmdb\Utils\Images\TmdbPoster;
use Kiwilan\Tmdb\Utils\Images\TmdbProfile;
use Kiwilan\Tmdb\Utils\Images\TmdbStill;
use Kiwilan\Tmdb\Utils\TmdbUrl;

define('BACKDROP_PATH', '/x2RS3uTcsJJ9IfjNPcgDmukoEcQ.jpg');
define('LOGO_PATH', '/2ycs64eqV5rqKYHyQK0GVoKGvfX.png');
define('POSTER_PATH', '/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg');
define('PROFILE_PATH', '/i6OuPNi7Fj6iitYXjpmrP18VLdP.jpg');
define('STILL_PATH', '/9hGF3WUkBf7cSjMg0cdMDHJkByd.jpg');

it('can get backdrop', function (TmdbBackdropSize $size) {
    clearMedia();

    $backdrop = TmdbBackdrop::make(BACKDROP_PATH)->size($size);
    expect($backdrop->getUrl())->toBe(TmdbUrl::IMAGE_URL.$size->value.BACKDROP_PATH);
    expect($backdrop->getImage())->toBeString();
    $path = mediaPath('/backdrop-'.$size->value.'.jpg');
    expect($backdrop->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(TmdbBackdropSize::cases());

it('can get logo', function (TmdbLogoSize $size) {
    clearMedia();

    $logo = TmdbLogo::make(LOGO_PATH)->size($size);
    expect($logo->getUrl())->toBe(TmdbUrl::IMAGE_URL.$size->value.LOGO_PATH);
    expect($logo->getImage())->toBeString();
    $path = mediaPath('/logo-'.$size->value.'.jpg');
    expect($logo->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(TmdbLogoSize::cases());

it('can get poster', function (TmdbPosterSize $size) {
    clearMedia();

    $poster = TmdbPoster::make(POSTER_PATH)->size($size);
    expect($poster->getUrl())->toBe(TmdbUrl::IMAGE_URL.$size->value.POSTER_PATH);
    expect($poster->getImage())->toBeString();
    $path = mediaPath('/poster-'.$size->value.'.jpg');
    expect($poster->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(TmdbPosterSize::cases());

it('can get profile', function (TmdbProfileSize $size) {
    clearMedia();

    $profile = TmdbProfile::make(PROFILE_PATH)->size($size);
    expect($profile->getUrl())->toBe(TmdbUrl::IMAGE_URL.$size->value.PROFILE_PATH);
    expect($profile->getImage())->toBeString();
    $path = mediaPath('/profile-'.$size->value.'.jpg');
    expect($profile->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(TmdbProfileSize::cases());

it('can get still', function (TmdbStillSize $size) {
    clearMedia();

    $still = TmdbStill::make(STILL_PATH)->size($size);
    expect($still->getUrl())->toBe(TmdbUrl::IMAGE_URL.$size->value.STILL_PATH);
    expect($still->getImage())->toBeString();
    $path = mediaPath('/still-'.$size->value.'.jpg');
    expect($still->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(TmdbStillSize::cases());

it('can fail on image downloading', function () {
    clearMedia();

    $poster = TmdbPoster::make(null);
    expect($poster->getUrl())->toBeNull();
    expect($poster->getImage())->toBeNull();
    $path = mediaPath('/poster.jpg');
    expect($poster->saveImage($path))->toBeFalse();
    expect(imageExists($path))->toBeFalse();
});
