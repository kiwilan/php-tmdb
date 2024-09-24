<?php

use Kiwilan\Tmdb\Tmdb;

it('can send raw request', function () {
    $response = Tmdb::client(apiKey())
        ->raw()
        ->url('/movie/now_playing', ['language' => 'en-US', 'page' => 1]);

    expect($response)->not->toBeNull();
    expect($response->isSuccess())->toBeTrue();
    expect($response->getStatusCode())->toBeTrue();
    expect($response->getUrl())->toBeString();
    expect($response->getBody())->toBeArray();
});
