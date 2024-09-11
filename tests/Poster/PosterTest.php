<?php

use Kiwilan\Tmdb\Enums\PosterSize;
use Kiwilan\Tmdb\Utils\TmdbPoster;

define('POSTER_URL', '/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg');

it('can get poster', function (PosterSize $size) {
    clearMedia();

    $poster = TmdbPoster::make(POSTER_URL, $size);
    expect($poster->getUrl())->toBe('https://image.tmdb.org/t/p/'.$size->value.POSTER_URL);
    expect($poster->getImage())->toBeString();
    $path = mediaPath('/poster-'.$size->value.'.jpg');
    expect($poster->saveImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
})->with(PosterSize::cases());
