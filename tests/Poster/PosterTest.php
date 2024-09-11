<?php

use Kiwilan\Tmdb\Enums\PosterSize;
use Kiwilan\Tmdb\Utils\TmdbPoster;

define('POSTER_PATH', '/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg');
define('BACKDROP_PATH', '/x2RS3uTcsJJ9IfjNPcgDmukoEcQ.jpg');

it('can get poster', function (PosterSize $size) {
    clearMedia();

    $poster = TmdbPoster::make(POSTER_PATH, $size);
    expect($poster->getUrl())->toBe('https://image.tmdb.org/t/p/'.$size->value.POSTER_PATH);
    expect($poster->getImage())->toBeString();
    $path = mediaPath('/poster-'.$size->value.'.jpg');
    expect($poster->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(PosterSize::cases());

it('can get backdrop', function (PosterSize $size) {
    clearMedia();

    $backdrop = TmdbPoster::make(BACKDROP_PATH, $size);
    expect($backdrop->getUrl())->toBe('https://image.tmdb.org/t/p/'.$size->value.BACKDROP_PATH);
    expect($backdrop->getImage())->toBeString();
    $path = mediaPath('/backdrop-'.$size->value.'.jpg');
    expect($backdrop->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(PosterSize::cases());
