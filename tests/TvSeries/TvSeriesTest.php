<?php

use Kiwilan\Tmdb\Tmdb;

it('can search tv series', function () {
    $tv = Tmdb::client(apiKey())->getTVSeries(1399);
    dump($tv);
});
