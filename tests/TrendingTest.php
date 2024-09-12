<?php

use Kiwilan\Tmdb\Enums\TimeWindow;
use Kiwilan\Tmdb\Models\Media;
use Kiwilan\Tmdb\Search;
use Kiwilan\Tmdb\Tmdb;

it('can use all', function () {
    $all = Tmdb::client(apiKey())
        ->trending()
        ->all(TimeWindow::WEEK, 'fr-FR');

    expect($all)->toBeInstanceOf(Search\SearchMedias::class);

    expect($all->getResults())->toBeArray();
    expect($all->getResults())->not()->toBeEmpty();
    expect($all->getFirstResult())->toBeInstanceOf(Media::class);
    expect($all->getResults())->each(fn (Pest\Expectation $movie) => expect($movie->value)->toBeInstanceOf(Media::class));
});

it('can use media', function () {
    $all = Tmdb::client(apiKey())
        ->trending()
        ->all(TimeWindow::WEEK, 'fr-FR');

    $first = $all->getFirstResult();
    expect($first)->toBeInstanceOf(Media::class);
    // dump($first);

    //   "title": "Rebel Ridge",
    //   "original_title": "Rebel Ridge",
    //   "overview": "A former Marine confronts corruption in a small town when local law enforcement unjustly seizes the bag of cash he needs to post his cousin's bail.",
    //   "poster_path": "/xEt2GSz9z5rSVpIHMiGdtf0czyf.jpg",
    //   "media_type": "movie",
    //   "adult": false,
    //   "original_language": "en",
    //   "genre_ids": [
    //     80,
    //     28,
    //     53
    //   ],
    //   "popularity": 831.205,
    //   "release_date": "2024-08-27",
    //   "video": false,
    //   "vote_average": 6.8,
    //   "vote_count": 292
});
