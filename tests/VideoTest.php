<?php

use Kiwilan\Tmdb\Models\Common\TmdbVideo;
use Kiwilan\Tmdb\Tmdb;

function apiCallMovie()
{
    return Tmdb::client(apiKey())
        ->movies()
        ->details(movie_id: 696506, append_to_response: ['videos']);
}

function apiCallTvShow()
{
    return Tmdb::client(apiKey())
        ->tvSeries()
        ->details(series_id: 87108, append_to_response: ['videos']);
}

function videoIs(TmdbVideo $video, string $type)
{
    expect($video)->toBeInstanceOf(TmdbVideo::class);
    expect($video->getType())->toBe($type);
    expect($video)->not()->toBeNull();
    expect($video->getYouTubeUrl())->toBeString();
}

it('can get movie teaser', function () {
    $movie = apiCallMovie();
    expect($movie->getVideos())->toBeArray();

    $video = $movie->getVideoTeaser();
    videoIs($video, 'Teaser');
});

it('can get movie trailer', function () {
    $movie = apiCallMovie();
    expect($movie->getVideos())->toBeArray();

    $trailer = $movie->getVideoTrailer();
    videoIs($trailer, 'Trailer');
});

it('can get movie promo', function () {
    $movie = apiCallMovie();
    expect($movie->getVideos())->toBeArray();

    $trailer = $movie->getVideoPromo();
    videoIs($trailer, 'Trailer');
});

it('can get movie trailer type', function () {
    $movie = apiCallMovie();
    expect($movie->getVideos())->toBeArray();

    $trailer = $movie->getVideoType('Trailer');
    videoIs($trailer, 'Trailer');
});

it('can get tv show teaser', function () {
    $movie = apiCallTvShow();
    expect($movie->getVideos())->toBeArray();

    $teaser = $movie->getVideoTeaser();
    videoIs($teaser, 'Teaser');
});

it('can get tv show trailer', function () {
    $movie = apiCallTvShow();
    expect($movie->getVideos())->toBeArray();

    $trailer = $movie->getVideoTrailer();
    videoIs($trailer, 'Trailer');
});

it('can get tv show promo', function () {
    $movie = apiCallTvShow();
    expect($movie->getVideos())->toBeArray();

    $promo = $movie->getVideoPromo();
    videoIs($promo, 'Trailer');
});

it('can get tv show trailer type', function () {
    $movie = apiCallTvShow();
    expect($movie->getVideos())->toBeArray();

    $trailer = $movie->getVideoType('Trailer');
    videoIs($trailer, 'Trailer');
});
