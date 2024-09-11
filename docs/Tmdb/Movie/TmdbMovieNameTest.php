<?php

use App\Facades\TmdbClient;

it('can scan L\'Amour flou', function () {
    $movie = TmdbClient::findMovie("L'Amour flou", 2018);

    expect($movie->getTitle())->toBe("L'Amour flou");
    expect($movie->getId())->toBe(539228);
});
