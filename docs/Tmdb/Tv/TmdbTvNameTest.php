<?php

use App\Facades\TmdbClient;

it('can scan Newton - Puberty', function () {
    $tv = TmdbClient::findTvShow('Newton - Puberty', 2015);

    expect($tv->getOriginalName())->toBe('Newton - Pubertet');
});
