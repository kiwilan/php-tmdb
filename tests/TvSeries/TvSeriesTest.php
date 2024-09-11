<?php

use Kiwilan\Tmdb\Models\Search\SearchTvSeries;
use Kiwilan\Tmdb\Models\TvSeries;
use Kiwilan\Tmdb\Tmdb;

// 1399
it('can search movie', function () {
    $results = Tmdb::client(apiKey())->searchTvSeries('game of thrones');

    expect($results)->not()->toBeNull();
    expect($results)->toBeInstanceOf(SearchTvSeries::class);
    expect($results->getResults())->toBeArray();
    expect($results->getResults())->not()->toBeEmpty();
    expect($results->getFirstResult())->toBeInstanceOf(TvSeries::class);
    expect($results->getTotalPages())->toBeInt();
    expect($results->getTotalResults())->toBeInt();
    expect($results->getPage())->toBeInt();
    dump($results);

    // #adult: false
    // #backdrop_path: "/zZqpAXxVSBtxV9qPBcscfXBcL2w.jpg"
    // #episode_run_time: null
    // #first_air_date: "2011-04-17"
    // #genres: []
    // #homepage: null
    // #id: 1399
    // #in_production: false
    // #languages: null
    // #last_air_date: null
    // #last_episode_to_air: Kiwilan\Tmdb\Models\TvSeries\EpisodeAir
    // #name: "Game of Thrones"
    // #next_episode_to_air: Kiwilan\Tmdb\Models\TvSeries\EpisodeAir
    // #networks: []
    // #number_of_episodes: null
    // #number_of_seasons: null
    // #origin_country: array:1 [
    //     0 => "US"
    // ]
    // #original_language: "en"
    // #original_name: "Game of Thrones"
    // #overview: "Seven noble families fight for control of the mythical land of Westeros. Friction between the houses leads to full-scale war. All while a very ancient evil awakens in the farthest north. Amidst the war, a neglected military order of misfits, the Night's Watch, is all that stands between the realms of men and icy horrors beyond."
    // #popularity: 1312.797
    // #poster_path: "/1XS1oqL89opfnbLl8WnZY1O1uJx.jpg"
    // #production_companies: []
    // #production_countries: []
    // #spoken_languages: []
    // #status: null
    // #tagline: null
    // #type: null
    // #vote_average: 8.454
    // #vote_count: 23808
    // #created_by: []
    // #recommendations: []

    $first = $results->getFirstResult();
    dump($first);
    // expect($first->isAdult())->toBeFalse();
    // expect($first->getBackdropPath())->toBeString();
    // expect($first->getGenreIds())->toBeArray();
    // expect($first->getId())->toBeInt();
    // expect($first->getOriginalLanguage())->toBeString();
    // expect($first->getOriginalTitle())->toBeString();
    // expect($first->getOverview())->toBeString();
    // expect($first->getPopularity())->toBeFloat();
    // expect($first->getPosterPath())->toBeString();
    // expect($first->getReleaseDate())->toBeInstanceOf(DateTime::class);
    // expect($first->getTitle())->toBeString();
    // expect($first->isVideo())->toBeFalse();
    // expect($first->getVoteAverage())->toBeFloat();
    // expect($first->getVoteCount())->toBeInt();
    // expect($first->isAdult())->toBeFalse();
    // expect($first->getBackdropPath())->toBeString();
    // expect($first->getGenreIds())->toBeArray();
    // expect($first->getId())->toBeInt();
    // expect($first->getOriginalLanguage())->toBeString();
    // expect($first->getOriginalTitle())->toBeString();
    // expect($first->getOverview())->toBeString();
    // expect($first->getPopularity())->toBeFloat();
    // expect($first->getPosterPath())->toBeString();
    // expect($first->getReleaseDate())->toBeInstanceOf(DateTime::class);
    // expect($first->getTitle())->toBeString();
    // expect($first->isVideo())->toBeFalse();
    // expect($first->getVoteAverage())->toBeFloat();
    // expect($first->getVoteCount())->toBeInt();
});
