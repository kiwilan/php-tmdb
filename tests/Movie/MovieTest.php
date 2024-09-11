<?php

use Kiwilan\Tmdb\Models\Genre;
use Kiwilan\Tmdb\Models\Movie;
use Kiwilan\Tmdb\Models\Movie\BelongsToCollection;
use Kiwilan\Tmdb\Models\ProductionCompany;
use Kiwilan\Tmdb\Models\ProductionCountry;
use Kiwilan\Tmdb\Models\Results\SearchMovies;
use Kiwilan\Tmdb\Tmdb;

it('can search movie', function () {
    $results = Tmdb::client(apiKey())->searchMovie('the fellowship of the ring');

    expect($results)->not()->toBeNull();
    expect($results)->toBeInstanceOf(SearchMovies::class);
    expect($results->getResults())->toBeArray();
    expect($results->getResults())->not()->toBeEmpty();
    expect($results->getFirstResult())->toBeInstanceOf(Movie::class);
    expect($results->getTotalPages())->toBeInt();
    expect($results->getTotalResults())->toBeInt();
    expect($results->getPage())->toBeInt();

    $first = $results->getFirstResult();
    expect($first->isAdult())->toBeFalse();
    expect($first->getBackdropPath())->toBeString();
    expect($first->getGenreIds())->toBeArray();
    expect($first->getId())->toBeInt();
    expect($first->getOriginalLanguage())->toBeString();
    expect($first->getOriginalTitle())->toBeString();
    expect($first->getOverview())->toBeString();
    expect($first->getPopularity())->toBeFloat();
    expect($first->getPosterPath())->toBeString();
    expect($first->getReleaseDate())->toBeString();
    expect($first->getTitle())->toBeString();
    expect($first->isVideo())->toBeFalse();
    expect($first->getVoteAverage())->toBeFloat();
    expect($first->getVoteCount())->toBeInt();
});

it('can get movie details (tmdb id)', function () {
    $movie = Tmdb::client(apiKey())->getMovie(120);
    expect($movie)->not()->toBeNull();
    expect($movie)->toBeInstanceOf(Movie::class);

    expect($movie->isAdult())->toBeFalse();
    expect($movie->getBackdropPath())->toBeString();
    expect($movie->getBelongsToCollection())->toBeInstanceOf(BelongsToCollection::class);
    expect($movie->getBudget())->toBeInt();
    expect($movie->getGenres())->toBeArray();
    expect($movie->getGenres())->not()->toBeEmpty();
    expect(reset($movie->getGenres()))->toBeInstanceOf(Genre::class);
    expect($movie->getHomepage())->toBeString();
    expect($movie->getId())->toBeInt();
    expect($movie->getImdbId())->toBeString();
    expect($movie->getOriginalLanguage())->toBeString();
    expect($movie->getOriginalTitle())->toBeString();
    expect($movie->getOverview())->toBeString();
    expect($movie->getPopularity())->toBeFloat();
    expect($movie->getPosterPath())->toBeString();
    expect($movie->getProductionCompanies())->toBeArray();
    expect($movie->getProductionCompanies())->not()->toBeEmpty();
    expect(reset($movie->getProductionCompanies()))->toBeInstanceOf(ProductionCompany::class);
    expect($movie->getProductionCountries())->toBeArray();
    expect($movie->getProductionCountries())->not()->toBeEmpty();
    expect(reset($movie->getProductionCountries()))->toBeInstanceOf(ProductionCountry::class);
    // expect($movie->getReleaseDate())->toBeString();
    expect($movie->getRevenue())->toBeInt();

    // #adult: false
    // #backdrop_path: "/x2RS3uTcsJJ9IfjNPcgDmukoEcQ.jpg"
    // #belongs_to_collection: Kiwilan\Tmdb\Models\Movie\BelongsToCollection^ {#732
    // +id: 119
    // +name: "The Lord of the Rings Collection"
    // +overview: null
    // +poster_path: "/oENY593nKRVL2PnxXsMtlh8izb4.jpg"
    // +backdrop_path: "/bccR2CGTWVVSZAG0yqmy3DIvhTX.jpg"
    // }
    // #budget: 93000000
    // #genre_ids: null
    // #genres: array:3 [
    // 0 => Kiwilan\Tmdb\Models\Genre^ {#737
    //     +id: 12
    //     +name: "Adventure"
    // }
    // 1 => Kiwilan\Tmdb\Models\Genre^ {#729
    //     +id: 14
    //     +name: "Fantasy"
    // }
    // 2 => Kiwilan\Tmdb\Models\Genre^ {#742
    //     +id: 28
    //     +name: "Action"
    // }
    // ]
    // #homepage: "http://www.lordoftherings.net/"
    // #id: 120
    // #imdb_id: "tt0120737"
    // #original_language: "en"
    // #original_title: "The Lord of the Rings: The Fellowship of the Ring"
    // #overview: "Young hobbit Frodo Baggins, after inheriting a mysterious ring from his uncle Bilbo, must leave his home in order to keep it from falling into the hands of its evil creator. Along the way, a fellowship is formed to protect the ringbearer and make sure that the ring arrives at its final destination: Mt. Doom, the only place where it can be destroyed."
    // #popularity: 174.668
    // #poster_path: "/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg"
    // #production_companies: array:3 [
    // 0 => Kiwilan\Tmdb\Models\ProductionCompany^ {#739
    //     +id: 12
    //     +logo_path: "/2ycs64eqV5rqKYHyQK0GVoKGvfX.png"
    //     +name: "New Line Cinema"
    //     +origin_country: "US"
    // }
    // 1 => Kiwilan\Tmdb\Models\ProductionCompany^ {#738
    //     +id: 11
    //     +logo_path: "/6FAuASQHybRkZUk08p9PzSs9ezM.png"
    //     +name: "WingNut Films"
    //     +origin_country: "NZ"
    // }
    // 2 => Kiwilan\Tmdb\Models\ProductionCompany^ {#731
    //     +id: 5237
    //     +logo_path: "/mlnr7vsBHvLye8oEb5A76C0t8x9.png"
    //     +name: "The Saul Zaentz Company"
    //     +origin_country: "US"
    // }
    // ]
    // #production_countries: array:2 [
    // 0 => Kiwilan\Tmdb\Models\ProductionCountry^ {#783
    //     +iso_3166_1: "NZ"
    //     +name: "New Zealand"
    // }
    // 1 => Kiwilan\Tmdb\Models\ProductionCountry^ {#730
    //     +iso_3166_1: "US"
    //     +name: "United States of America"
    // }
    // ]
    // #release_date: "2001-12-18"
    // #revenue: 871368364
    // #runtime: 179
    // #spoken_languages: array:1 [
    // 0 => Kiwilan\Tmdb\Models\SpokenLanguage^ {#735
    //     +english_name: "English"
    //     +iso_639_1: "en"
    //     +name: "English"
    // }
    // ]
    // #status: "Released"
    // #tagline: "One ring to rule them all."
    // #title: "The Lord of the Rings: The Fellowship of the Ring"
    // #video: false
    // #vote_average: 8.414
    // #vote_count: 24832
    // #alternative_titles: null
    // #credits: null
    // #release_dates: null
    // #recommendations: null
    // #similar: null
});

it('can get null if movie not exists (tmdb id)', function () {
    $movie = Tmdb::client(apiKey())->getMovie(50000000);
    expect($movie)->toBeNull();
});

//     $repository = new MovieRepository(TmdbClient::connect());
//     /** @var Movie */
//     $m = $repository->load(87421, [
//         'append_to_response' => 'alternative_titles,credits,release_dates,recommendations,similar',
//     ]);

//     expect($m->getAdult())->toBeFalse();
//     expect($m->getBackdropPath())->toBeString();
//     expect($m->getBelongsToCollection())->toBe([
//         'id' => 2794,
//         'name' => 'The Chronicles of Riddick Collection',
//         'poster_path' => '/2jEN9v4myEXgtX6fdkOdGW1noLr.jpg',
//         'backdrop_path' => '/n5jED8ITkX9VgFCZXsznhk9ERbA.jpg',
//     ]);
//     expect($m->getBudget())->toBeInt();
//     expect($m->getGenres())->toBeObject();

//     $alternativeTitles = TmdbClient::loadAlternativeTitles($m);
//     expect($alternativeTitles->french)->toBe('Riddick: Domptez les ténèbres');
//     expect($alternativeTitles->english)->toBe('The Chronicles of Riddick: Dead Man Stalking');
//     expect($alternativeTitles->original)->toBe('Riddick');

//     $genres = [];
//     foreach ($m->getGenres()->getGenres() as $genre) {
//         $genres[] = [
//             'id' => $genre->getId(),
//             'name' => $genre->getName(),
//         ];
//     }
//     expect($genres)->toBe([
//         0 => [
//             'id' => 878,
//             'name' => 'Science Fiction',
//         ],
//         [
//             'id' => 28,
//             'name' => 'Action',
//         ],
//         [
//             'id' => 53,
//             'name' => 'Thriller',
//         ],
//     ]);
// });

// it('can parse movie', function () {
//     $movie = TmdbClient::findMovie('Riddick', 2013);

//     expect($movie)->not()->toBeNull();
//     expect($movie->getId())->toBe(87421);
//     expect($movie->getTitle())->toBe('Riddick');
//     expect($movie->getOriginalTitle())->toBe('Riddick');
//     expect($movie->getReleaseDate()->format('Y-m-d'))->toBe('2013-09-02');
//     expect($movie->getOriginalLanguage())->toBe('en');
//     expect($movie->getOverview())->toBeString();
//     expect($movie->getPopularity())->toBeFloat();
//     expect($movie->getVoteAverage())->toBeFloat();
//     expect($movie->getVoteCount())->toBeInt();
//     expect($movie->getHomepage())->toBe('https://www.uphe.com/movies/riddick');
//     expect($movie->getBackdropPath())->toStartWith('/');
//     expect($movie->getPosterPath())->toStartWith('/');
//     expect($movie->getBudget())->toBe(38000000);
//     expect($movie->getRevenue())->toBe(98337295);
//     expect($movie->getStatus())->toBe('Released');
//     expect($movie->getTagline())->toBe('Survival Is His Revenge');
//     expect($movie->getRuntime())->toBe(119);
//     expect($movie->getAdult())->toBeFalse();
//     expect($movie->getImdbId())->toBe('tt1411250');

//     $alternativeTitles = TmdbClient::loadAlternativeTitles($movie);
//     expect($alternativeTitles->french)->toBe('Riddick: Domptez les ténèbres');
//     expect($alternativeTitles->english)->toBe('The Chronicles of Riddick: Dead Man Stalking');
//     expect($alternativeTitles->original)->toBe('Riddick');
//     expect($alternativeTitles->has_alternative_titles)->toBeTrue();

//     $genres = TmdbClient::loadGenres($movie);
//     expect($genres)->not()->toBeNull();
//     expect(count($genres))->toBe(3);
//     expect($genres[0]->getId())->toBe(878);
//     expect($genres[0]->getName())->toBe('Science Fiction');
//     expect($genres[1]->getId())->toBe(28);
//     expect($genres[1]->getName())->toBe('Action');
//     expect($genres[2]->getId())->toBe(53);
//     expect($genres[2]->getName())->toBe('Thriller');

//     $countries = TmdbClient::loadCountries($movie);
//     expect($countries)->not()->toBeNull();
//     expect(count($countries))->toBe(2);
//     expect($countries[1]->getIso31661())->toBe('US');
//     expect($countries[1]->getName())->toBe('United States of America');

//     $companies = TmdbClient::loadCompanies($movie);
//     expect($companies)->not()->toBeNull();
//     expect(count($companies))->toBe(5);
//     expect($companies[0]->getId())->toBe(1225);
//     expect($companies[0]->getName())->toBe('One Race');

//     $belongs_to = TmdbClient::loadBelongsTo($movie);
//     expect($belongs_to->id)->toBe(2794);
//     expect($belongs_to->name)->toBe('The Chronicles of Riddick Collection');
//     expect($belongs_to->poster_path)->toStartWith('/');
//     expect($belongs_to->backdrop_path)->toStartWith('/');

//     $similars = TmdbClient::loadSimilars($movie);
//     expect($similars)->not()->toBeNull();

//     $first = reset($similars);
//     expect($first)->toBeInstanceOf(Movie::class);

//     $recommendations = TmdbClient::loadRecommendations($movie);
//     expect($recommendations)->not()->toBeNull();

//     $pitch_black = array_filter($recommendations, fn (\Tmdb\Model\Movie $m) => $m->getTitle() === 'Pitch Black');
//     $pitch_black = reset($pitch_black);

//     expect($pitch_black->getTitle())->toBe('Pitch Black');

//     $release_date = TmdbClient::loadReleaseDate($movie);
//     expect($release_date->getIso31661())->toBe('US');
//     expect($release_date->getCertification())->toBe('R');
//     expect($release_date->getReleaseDate()->format('Y-m-d'))->toBe('2013-09-06');
//     expect($release_date->getType())->toBe(3);
// });

// it('cam parse credits', function () {
//     $movie = TmdbClient::findMovie('Riddick', 2013);

//     $credits = $movie->getCredits();

//     $cast = $credits->getCast();
//     $crew = $credits->getCrew();
//     $guestStars = $credits->getGuestStars();
//     $creators = TmdbClient::loadCreators($movie);

//     expect($cast->getCast())->toBeArray();
//     expect($crew->getCrew())->toBeArray();
//     expect($guestStars->getGuestStars())->toBeArray();
//     expect($creators)->toBeArray();

//     expect($creators[0])->toBeInstanceOf(\Tmdb\Model\Person\CrewMember::class);
//     expect($creators[0]->getId())->toBe(28239);
//     expect($creators[0]->getName())->toBe('David Twohy');
//     expect($creators[0]->getJob())->toBe('Director');

//     $vin_diesel = array_filter($cast->getCast(), fn ($item) => $item->getName() === 'Vin Diesel');
//     $vin_diesel_key = array_key_first($vin_diesel);
//     $vin_diesel = $vin_diesel[$vin_diesel_key];

//     expect($vin_diesel->getId())->toBe(12835);
//     expect($vin_diesel->getName())->toBe('Vin Diesel');
//     expect($vin_diesel->getProfilePath())->toBeString();

//     $david_twohy = array_filter($crew->getCrew(), fn ($item) => $item->getName() === 'David Twohy');
//     $david_twohy_key = array_key_first($david_twohy);
//     $david_twohy = $david_twohy[$david_twohy_key];

//     expect($david_twohy->getId())->toBe(28239);
//     expect($david_twohy->getName())->toBe('David Twohy');
//     expect($david_twohy->getProfilePath())->toBeString();

//     $modelCasts = TmdbClient::loadCreditsCast($movie);
//     $vin_diesel = array_filter($modelCasts, fn (\Tmdb\Model\Person\CastMember $item) => $item->getName() === 'Vin Diesel')[0];

//     expect($vin_diesel->getId())->toBe(12835);
//     expect($vin_diesel->getName())->toBe('Vin Diesel');
//     expect($vin_diesel->getProfilePath())->toBeString();
//     expect($vin_diesel->getProfilePath())->toStartWith('/');
//     expect($vin_diesel->getCharacter())->toBe('Riddick');
//     expect($vin_diesel->getOrder())->toBe(0);
//     expect($vin_diesel->getCastId())->toBe(1);
//     expect($vin_diesel->getCreditId())->toBe('52fe49c39251416c910b810b');

//     $modelCrews = TmdbClient::loadCreditsCrew($movie);
//     $david_twohy = array_filter($modelCrews, fn (\Tmdb\Model\Person\CrewMember $item) => $item->getName() === 'David Twohy')[0];

//     expect($david_twohy->getId())->toBe(28239);
//     expect($david_twohy->getName())->toBe('David Twohy');
//     expect($david_twohy->getProfilePath())->toBeString();
//     expect($david_twohy->getProfilePath())->toStartWith('/');
//     expect($david_twohy->getDepartment())->toBe('Writing');
//     expect($david_twohy->getJob())->toBe('Writer');
//     expect($david_twohy->getCreditId())->toBe('52fe49c39251416c910b8125');
// });
