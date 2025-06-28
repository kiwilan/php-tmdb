<?php

use Kiwilan\Tmdb\Models\Common\TmdbVideo;
use Kiwilan\Tmdb\Tmdb;

function apiCall()
{
    return Tmdb::client(apiKey())
        ->movies()
        ->details(movie_id: 696506, append_to_response: ['videos']);
}

it('can get teaser', function () {
    $movie = apiCall();
    expect($movie->getVideos())->toBeArray();

    $teaser = $movie->getVideoTeaser();
    expect($teaser)->toBeInstanceOf(TmdbVideo::class);
    expect($teaser->getType())->toBe('Teaser');
    expect($teaser)->not()->toBeNull();
    expect($teaser->getYouTubeUrl())->toBeString();
});

it('can get trailer', function () {
    $movie = apiCall();
    expect($movie->getVideos())->toBeArray();

    $trailer = $movie->getVideoTrailer();
    expect($trailer)->toBeInstanceOf(TmdbVideo::class);
    expect($trailer->getType())->toBe('Trailer');
    expect($trailer)->not()->toBeNull();
    expect($trailer->getYouTubeUrl())->toBeString();
});

it('can get promo', function () {
    $movie = apiCall();
    expect($movie->getVideos())->toBeArray();

    $trailer = $movie->getVideoPromo();
    expect($trailer)->toBeInstanceOf(TmdbVideo::class);
    expect($trailer->getType())->toBe('Trailer');
    expect($trailer)->not()->toBeNull();
    expect($trailer->getYouTubeUrl())->toBeString();
});

it('can get trailer type', function () {
    $movie = apiCall();
    expect($movie->getVideos())->toBeArray();

    $trailer = $movie->getVideoType('Trailer');
    expect($trailer)->toBeInstanceOf(TmdbVideo::class);
    expect($trailer->getType())->toBe('Trailer');
    expect($trailer)->not()->toBeNull();
    expect($trailer->getYouTubeUrl())->toBeString();
});
