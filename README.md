# PHP TMDB

![Banner with a lots of movies and TV series in background and PHP TMDB title](https://raw.githubusercontent.com/kiwilan/php-tmdb/main/docs/banner.jpg)

[![php][php-version-src]][php-version-href]
[![version][version-src]][version-href]
[![downloads][downloads-src]][downloads-href]
[![license][license-src]][license-href]
[![tests][tests-src]][tests-href]
[![codecov][codecov-src]][codecov-href]

PHP wrapper package to interact with the [The Movie Database (TMDB) API](https://www.themoviedb.org/documentation/api).

> [!IMPORTANT]
> You need to create an account on [TMDB](https://www.themoviedb.org/) and get an **_API key_** to use this package. It's free and easy to do, you can read [this guide](https://developer.themoviedb.org/docs/getting-started) to get started.

> [!WARNING]
> This package is under development.

## Requirements

**PHP 8.1** and later.

> [!NOTE]
> Package [`guzzlehttp/guzzle`](https://github.com/guzzle/guzzle) will be installed automatically by [`composer`](https://getcomposer.org/).

## About

This package uses repository pattern to interact with the TMDB API. Each repository represents an API category like _Movies_, _Search_, _Trending_, etc. And each endpoint of API is a method in repository, like `details()` for _Movies_, `movie()` for _Search_, `all()` for _Trending_, etc. If you know TMDB API, you will understand this package easily.

_This is NOT official TMDB API PHP wrapper, you can check [`php-tmdb/api`](https://github.com/php-tmdb/api) if you want official package._

_Why this package?_

_All current PHP packages to interact with the TMDB API are not up-to-date and I need a modern and easy-to-use package to interact with the TMDB API. So I decided to create this package. You can check [`roadmap`](#roadmap) to see what I plan to do with this package._

## Installation

You can install the package via [composer](https://getcomposer.org/):

```bash
composer require kiwilan/php-tmdb
```

## Usage of API

### Basic example

You have just to use `client()` static method to get new instance of `Tmdb` class with your API key. After that, you can use repositories with chained methods to interact with the TMDB API, first chained method is a repository, corresponding to a category of the API. And second chained method is an endpoint of the API.

```php
use Kiwilan\Tmdb\Tmdb;

$results = Tmdb::client('API_KEY')
    ->search()
    ->movie(query: 'the lord of the rings'); // ?\Kiwilan\Tmdb\Results\MovieResults
```

### Collection

#### [Collection: Details](https://developer.themoviedb.org/reference/collection-details)

Get collection details by ID.

```php
use Kiwilan\Tmdb\Tmdb;

$collection = Tmdb::client('API_KEY')
    ->collections()
    ->details(collection_id: 119); // ?\Kiwilan\Tmdb\Models\TmdbCollection
```

#### [Collection: Images](https://developer.themoviedb.org/reference/collection-images)

Get the images that belong to a collection.

```php
$images = Tmdb::client('API_KEY')
    ->collections()
    ->images(collection_id: 119); // ?\Kiwilan\Tmdb\Models\Images\TmdbImages
```

#### [Collection: Translations](https://developer.themoviedb.org/reference/collection-translations)

Get the translations that belong to a collection.

```php
$translations = Tmdb::client('API_KEY')
    ->collections()
    ->translations(collection_id: 119); // ?\Kiwilan\Tmdb\Models\Translations\TmdbTranslations
```

### Companies

#### [Companies: Details](https://developer.themoviedb.org/reference/company-details)

Get the company details by ID.

```php
use Kiwilan\Tmdb\Tmdb;

$company = Tmdb::client('API_KEY')
    ->companies()
    ->details(company_id: 12); // ?\Kiwilan\Tmdb\Models\TmdbCompany
```

### Credits

#### [Credits: Details](https://developer.themoviedb.org/reference/credit-details)

Get a movie or TV credit details by ID.

```php
use Kiwilan\Tmdb\Tmdb;

$credit = Tmdb::client('API_KEY')
    ->credits()
    ->details(credit_id: '5256c8b219c2956ff6047cd8'); // ?\Kiwilan\Tmdb\Models\TmdbCredit
```

### Movie Lists

#### [Movie Lists: Now Playing](https://developer.themoviedb.org/reference/movie-now-playing-list)

Get a list of movies that are currently in theatres.

```php
use Kiwilan\Tmdb\Tmdb;

$now_playing = Tmdb::client('API_KEY')
    ->movieLists()
    ->nowPlaying(); // ?\Kiwilan\Tmdb\Results\MovieResults
```

#### [Movie Lists: Popular](https://developer.themoviedb.org/reference/movie-popular-list)

Get a list of movies ordered by popularity.

```php
$popular = Tmdb::client('API_KEY')
    ->movieLists()
    ->popular(); // ?\Kiwilan\Tmdb\Results\MovieResults
```

#### [Movie Lists: Top Rated](https://developer.themoviedb.org/reference/movie-top-rated-list)

Get a list of movies ordered by rating.

```php
$top_rated = Tmdb::client('API_KEY')
    ->movieLists()
    ->topRated(); // ?\Kiwilan\Tmdb\Results\MovieResults
```

#### [Movie Lists: Upcoming](https://developer.themoviedb.org/reference/movie-upcoming-list)

Get a list of movies that are being released soon.

```php
$upcoming = Tmdb::client('API_KEY')
    ->movieLists()
    ->upcoming(); // ?\Kiwilan\Tmdb\Results\MovieResults
```

### Movies

#### [Movies: Details](https://developer.themoviedb.org/reference/movie-details)

Get the top level details of a movie by ID (you can use `append_to_response` option to get more details).

```php
use Kiwilan\Tmdb\Tmdb;

$movie = Tmdb::client('API_KEY')
    ->movies()
    ->details(movie_id: 120); // ?\Kiwilan\Tmdb\Models\TmdbMovie
```

### Networks

#### [Networks: Details](https://developer.themoviedb.org/reference/network-details)

Get the details of a network by ID.

```php
use Kiwilan\Tmdb\Tmdb;

$network = Tmdb::client('API_KEY')
    ->networks()
    ->details(network_id: 49); // ?\Kiwilan\Tmdb\Models\TvSeries\TmdbNetwork
```

### Search

#### [Search: Collection](https://developer.themoviedb.org/reference/search-collection)

Search for collections by their original, translated and alternative names.

```php
use Kiwilan\Tmdb\Tmdb;

$results = Tmdb::client('API_KEY')
    ->search()
    ->movie(query: 'the lord of the rings');

$collections = $results->getResults(); // \Kiwilan\Tmdb\Models\TmdbCollection[]
$firstCollection = $results->getFirstResult(); // ?\Kiwilan\Tmdb\Models\TmdbCollection
```

You can use options into your search:

```php
use Kiwilan\Tmdb\Tmdb;
use Kiwilan\Tmdb\Query\SearchCollectionQuery;

$results = Tmdb::client('API_KEY')
    ->search()
    ->collection(query: 'le seigneur des anneaux', params: new SearchCollectionQuery(
        include_adult: true,
        language: 'fr-FR',
        page: 1,
        year: 2001,
    ));
```

#### [Search: Movie](https://developer.themoviedb.org/reference/search-movie)

Search for movies by their original, translated and alternative titles.

```php
use Kiwilan\Tmdb\Tmdb;

$results = Tmdb::client('API_KEY')
    ->search()
    ->movie(query:'the fellowship of the ring');

$movies = $results->getResults(); // \Kiwilan\Tmdb\Models\TmdbMovie[]
$firstMovie = $results->getFirstResult(); // ?\Kiwilan\Tmdb\Models\TmdbMovie
```

You can use options into your search:

```php
use Kiwilan\Tmdb\Tmdb;
use Kiwilan\Tmdb\Query\SearchMovieQuery;

$results = Tmdb::client('API_KEY')
    ->search()
    ->movie(query: 'le seigneur des anneaux', params: new SearchMovieQuery(
        include_adult: true,
        language: 'fr-FR',
        primary_release_year: 2001,
        page: 1,
        region: 'en-US',
        year: 2001,
    ));
```

#### [Search: TV](https://developer.themoviedb.org/reference/search-tv)

Search for TV shows by their original, translated and also known as names.

```php
use Kiwilan\Tmdb\Tmdb;

$results = Tmdb::client('API_KEY')
    ->search()
    ->tv(query: 'game of thrones');

$tvSeries = $results->getResults(); // \Kiwilan\Tmdb\Models\TmdbTvSeries[]
$firstTvSeries = $results->getFirstResult(); // ?\Kiwilan\Tmdb\Models\TmdbTvSeries
```

You can use options into your search:

```php
use Kiwilan\Tmdb\Tmdb;
use Kiwilan\Tmdb\Query\SearchTvSeriesQuery;

$results = Tmdb::client('API_KEY')
    ->search()
    ->tv(query: 'game of thrones', params: new SearchTvSeriesQuery(
        first_air_date_year: 2011,
        include_adult: true,
        language: 'fr-FR',
        page: 1,
        year: 2011,
    ));
```

### Trending

#### [Trending: All](https://developer.themoviedb.org/reference/trending-all)

Get the trending movies, TV shows and people.

```php
use Kiwilan\Tmdb\Tmdb;

$all = Tmdb::client('API_KEY')
    ->trending()
    ->all(); // ?\Kiwilan\Tmdb\Results\MediaResults
```

#### [Trending: Movies](https://developer.themoviedb.org/reference/trending-movies)

Get the trending movies on TMDB.

```php
use Kiwilan\Tmdb\Tmdb;

$movies = Tmdb::client('API_KEY')
    ->trending()
    ->movies(); // ?\Kiwilan\Tmdb\Results\MovieResults
```

#### [Trending: People](https://developer.themoviedb.org/reference/trending-people)

Get the trending people on TMDB.

```php
use Kiwilan\Tmdb\Tmdb;

$people = Tmdb::client('API_KEY')
    ->trending()
    ->people(); // ?\Kiwilan\Tmdb\Results\PeopleResults
```

#### [Trending: TV](https://developer.themoviedb.org/reference/trending-tv)

Get the trending TV shows on TMDB.

```php
use Kiwilan\Tmdb\Tmdb;

$tv = Tmdb::client('API_KEY')
    ->trending()
    ->tv(); // ?\Kiwilan\Tmdb\Results\TvSerieResults
```

### TV Series List

#### [TV Series List: Airing Today](https://developer.themoviedb.org/reference/tv-series-airing-today-list)

Get a list of TV shows airing today.

```php
$airing_today = Tmdb::client('API_KEY')
    ->tvSeriesList()
    ->airingToday(); // ?\Kiwilan\Tmdb\Results\TvSerieResults
```

#### [TV Series List: On The Air](https://developer.themoviedb.org/reference/tv-series-on-the-air-list)

Get a list of TV shows that air in the next 7 days.

```php
$on_the_air = Tmdb::client('API_KEY')
    ->tvSeriesList()
    ->onTheAir(); // ?\Kiwilan\Tmdb\Results\TvSerieResults
```

#### [TV Series List: Popular](https://developer.themoviedb.org/reference/tv-series-popular-list)

Get a list of TV shows ordered by popularity.

```php
$popular = Tmdb::client('API_KEY')
    ->tvSeriesList()
    ->popular(); // ?\Kiwilan\Tmdb\Results\TvSerieResults
```

#### [TV Series List: Top Rated](https://developer.themoviedb.org/reference/tv-series-top-rated-list)

Get a list of TV shows ordered by rating.

```php
$top_rated = Tmdb::client('API_KEY')
    ->tvSeriesList()
    ->topRated(); // ?\Kiwilan\Tmdb\Results\TvSerieResults
```

### TV Series

#### [TV Series: Details](https://developer.themoviedb.org/reference/tv-series-details)

Get the details of a TV show (you can use `append_to_response` option to get more details).

```php
use Kiwilan\Tmdb\Tmdb;

$tvSeries = Tmdb::client('API_KEY')
    ->tvSeries()
    ->details(series_id: 1399); // ?\Kiwilan\Tmdb\Models\TmdbTvSeries
```

### TV Seasons

#### [TV Seasons: Details](https://developer.themoviedb.org/reference/tv-season-details)

Query the details of a TV season (you can use `append_to_response` option to get more details).

```php
use Kiwilan\Tmdb\Tmdb;

$season = Tmdb::client('API_KEY')
    ->tvSeasons()
    ->details(series_id: 1399, season_number: 1); // ?\Kiwilan\Tmdb\Models\TmdbSeason
```

### TV Episodes

#### [TV Episodes: Details](https://developer.themoviedb.org/reference/tv-episode-details)

Query the details of a TV episode (you can use `append_to_response` option to get more details).

```php
use Kiwilan\Tmdb\Tmdb;

$episode = Tmdb::client('API_KEY')
    ->tvEpisodes()
    ->details(series_id: 1399, season_number: 1, episode_number: 1); // ?\Kiwilan\Tmdb\Models\TmdbEpisode
```

## Advanced

### Results

For any method that returns a list of results, you can use multiple methods:

```php
use Kiwilan\Tmdb\Tmdb;

$movies = Tmdb::client('API_KEY')
    ->movieLists()
    ->popular(); // ?\Kiwilan\Tmdb\Results\MovieResults

$results = $movies->getResults(); // \Kiwilan\Tmdb\Models\TmdbMovie[]
$firstResult = $movies->getFirstResult(); // ?\Kiwilan\Tmdb\Models\TmdbMovie
$lastResult = $movies->getLastResult(); // ?\Kiwilan\Tmdb\Models\TmdbMovie
$filterResults = $movies->filter(fn (\Kiwilan\Tmdb\Models\TmdbMovie $movie) => $movie->getVoteAverage() > 8); // \Kiwilan\Tmdb\Models\TmdbMovie[]
$findResult = $movies->find(fn (\Kiwilan\Tmdb\Models\TmdbMovie $movie) => $movie->getVoteAverage() > 8); // ?\Kiwilan\Tmdb\Models\TmdbMovie
```

### Images

For any model with image (poster, backdrop, logo, profile, still), you can use multiple methods:

```php
use Kiwilan\Tmdb\Tmdb;

$movie = Tmdb::client('API_KEY')
    ->movies()
    ->details(movie_id: 120); // ?\Kiwilan\Tmdb\Models\TmdbMovie

$poster_path = $movie->getPosterPath(); // string|null (path to poster)
$poster_url = $movie->getPosterUrl(); // string|null (URL to poster)
$poster_image = $movie->getPosterImage(); // string|null (binary image)
$success = $movie->savePosterImage('path/to/save/poster.jpg'); // bool (true if success)
```

You can change the size of the image with `size` option, available for `get*Url`, `get*Image` and `save*Image` methods:

```php
use Kiwilan\Tmdb\Tmdb;
use Kiwilan\Tmdb\Enums\PosterSize;

$movie = Tmdb::client('API_KEY')
    ->movies()
    ->details(movie_id: 120); // ?\Kiwilan\Tmdb\Models\TmdbMovie

$poster_url = $movie->getPosterUrl(size: PosterSize::W500); // string|null (URL to poster)
```

These methods are available for `Poster`, `Backdrop`, `Logo`, `Profile` and `Still`.

### Append to response

TMDB offers an easy way to get more details with `append_to_response` option. You can add more data in same request, it's really useful to get all data you need in one request.

> `append_to_response` is an easy and efficient way to append extra requests to any top level namespace. The movie, TV show, TV season, TV episode and person detail methods all support a query parameter called `append_to_response`. This makes it possible to make sub requests within the same namespace in a single HTTP request. Each request will get appended to the response as a new JSON object.
> From <https://developer.themoviedb.org/docs/append-to-response>

To know which methods support `append_to_response`, check if method has `append_to_response` parameter (always optional and at the end of parameters). And to know what you can add, check the [official documentation](https://developer.themoviedb.org/docs/getting-started).

Example with `append_to_response`:

```php
use Kiwilan\Tmdb\Tmdb;

$movie = Tmdb::client('API_KEY')
    ->movies()
    ->details(movie_id: 120, append_to_response: ['credits' ,'videos']); // ?\Kiwilan\Tmdb\Models\TmdbMovie
```

### Get raw data

If you want to get raw data from TMDB API, you can use `getRawData()` method and `getRawDataKey()` method to get a specific key.

> [!NOTE]
>
> If a key hasn't dedicated method, you can use `getRawDataKey()` method to get it but don't hesitate to open an issue to ask for a dedicated method.

```php
use Kiwilan\Tmdb\Tmdb;

$movie = Tmdb::client('API_KEY')
    ->movies()
    ->details(movie_id: 120); // ?\Kiwilan\Tmdb\Models\TmdbMovie

$raw_data = $movie->getRawData(); // array
$raw_title_key = $movie->getRawDataKey('title'); // mixed
```

### Send raw request

If you want to send a raw request to TMDB API, you can use `raw()` method, API key will be added automatically.

```php
use Kiwilan\Tmdb\Tmdb;

$response = Tmdb::client(apiKey())
    ->raw()
    ->url('/movie/now_playing', ['language' => 'en-US', 'page' => 1]); // ?Kiwi\Tmdb\Repositories\RawRepository

$response->isSuccess(); // bool
$response->getStatusCode(); // int
$response->getBody(); // array
$response->getUrl(); // string
```

## Testing

```bash
composer test
```

## Contributing

A fix? A new feature? A typo? You're welcome to contribute to this project. Just open a pull request.

### Roadmap

-   [ ] [Account](https://developer.themoviedb.org/reference/account-details)
-   [ ] [Authentication](https://developer.themoviedb.org/reference/authentication-create-guest-session)
-   [ ] Certifications
    -   [ ] [Movie Certifications](https://developer.themoviedb.org/reference/certification-movie-list)
    -   [ ] [TV Certifications](https://developer.themoviedb.org/reference/certifications-tv-list)
-   [ ] Changes
    -   [ ] [Movie List](https://developer.themoviedb.org/reference/changes-movie-list)
    -   [ ] [People List](https://developer.themoviedb.org/reference/changes-people-list)
    -   [ ] [TV List](https://developer.themoviedb.org/reference/changes-tv-list)
-   [x] ~~Collections~~
    -   [x] ~~[Details](https://developer.themoviedb.org/reference/collection-details)~~
    -   [x] ~~[Images](https://developer.themoviedb.org/reference/collection-images)~~
    -   [x] ~~[Translations](https://developer.themoviedb.org/reference/collection-translations)~~
-   [ ] Companies
    -   [x] ~~[Details](https://developer.themoviedb.org/reference/company-details)~~
    -   [ ] [Alternative Names](https://developer.themoviedb.org/reference/company-alternative-names)
    -   [ ] [Images](https://developer.themoviedb.org/reference/company-images)
-   [ ] [Configuration](https://developer.themoviedb.org/reference/configuration-details)
-   [x] ~~Credits~~
    -   [x] ~~[Details](https://developer.themoviedb.org/reference/credit-details)~~
-   [ ] Discover
    -   [ ] [Movie](https://developer.themoviedb.org/reference/discover-movie)
    -   [ ] [TV](https://developer.themoviedb.org/reference/discover-tv)
-   [ ] Find
    -   [ ] [By ID](https://developer.themoviedb.org/reference/find-by-id)
-   [ ] Genres
    -   [ ] [Movie List](https://developer.themoviedb.org/reference/genre-movie-list)
    -   [ ] [TV List](https://developer.themoviedb.org/reference/genre-tv-list)
-   [ ] [Guest Sessions](https://developer.themoviedb.org/reference/guest-session-rated-movies)
-   [ ] Keywords
    -   [Details](https://developer.themoviedb.org/reference/keyword-details)
    -   [Movies](https://developer.themoviedb.org/reference/keyword-movies) (deprecated)
-   [ ] [Lists](https://developer.themoviedb.org/reference/list-add-movie)
-   [x] ~~Movie Lists~~
    -   [x] ~~[Now playing](https://developer.themoviedb.org/reference/movie-now-playing-list)~~
    -   [x] ~~[Popular](https://developer.themoviedb.org/reference/movie-popular-list)~~
    -   [x] ~~[Top Rated](https://developer.themoviedb.org/reference/movie-top-rated-list)~~
    -   [x] ~~[Upcoming](https://developer.themoviedb.org/reference/movie-upcoming-list)~~
-   [ ] Movies
    -   [x] ~~[Details](https://developer.themoviedb.org/reference/movie-details)~~
    -   [ ] [Account States](https://developer.themoviedb.org/reference/movie-account-states)
    -   [ ] [Alternative Titles](https://developer.themoviedb.org/reference/movie-alternative-titles): for v1
    -   [ ] [Changes](https://developer.themoviedb.org/reference/movie-changes)
    -   [ ] [Credits](https://developer.themoviedb.org/reference/movie-credits): for v1
    -   [ ] [External IDs](https://developer.themoviedb.org/reference/movie-external-ids)
    -   [ ] [Images](https://developer.themoviedb.org/reference/movie-images)
    -   [ ] [Keywords](https://developer.themoviedb.org/reference/movie-keywords): for v1
    -   [ ] [Latest](https://developer.themoviedb.org/reference/movie-latest-id)
    -   [ ] [Lists](https://developer.themoviedb.org/reference/movie-lists)
    -   [ ] [Recommendations](https://developer.themoviedb.org/reference/movie-recommendations): for v1
    -   [ ] [Release Dates](https://developer.themoviedb.org/reference/movie-release-dates): for v1
    -   [ ] [Reviews](https://developer.themoviedb.org/reference/movie-reviews): for v1
    -   [ ] [Similar](https://developer.themoviedb.org/reference/movie-similar): for v1
    -   [ ] [Translations](https://developer.themoviedb.org/reference/movie-translations)
    -   [ ] [Videos](https://developer.themoviedb.org/reference/movie-videos): for v1
    -   [ ] [Watch Providers](https://developer.themoviedb.org/reference/movie-watch-providers)
    -   [ ] [Add Rating](https://developer.themoviedb.org/reference/movie-add-rating)
    -   [ ] [Delete Rating](https://developer.themoviedb.org/reference/movie-delete-rating)
-   [ ] Networks
    -   [x] ~~[Details](https://developer.themoviedb.org/reference/network-details)~~
    -   [ ] [Alternative Names](https://developer.themoviedb.org/reference/details-copy)
    -   [ ] [Images](https://developer.themoviedb.org/reference/alternative-names-copy)
-   [ ] People Lists
    -   [ ] [Popular](https://developer.themoviedb.org/reference/person-popular-list)
-   [ ] People
    -   [ ] [Details](https://developer.themoviedb.org/reference/person-details): for v1
    -   [ ] [Changes](https://developer.themoviedb.org/reference/person-changes)
    -   [ ] [Combined Credits](https://developer.themoviedb.org/reference/person-combined-credits)
    -   [ ] [External IDs](https://developer.themoviedb.org/reference/person-external-ids)
    -   [ ] [Images](https://developer.themoviedb.org/reference/person-images)
    -   [ ] [Latest](https://developer.themoviedb.org/reference/person-popular-list)
    -   [ ] [Movie Credits](https://developer.themoviedb.org/reference/person-movie-credits)
    -   [ ] [TV Credits](https://developer.themoviedb.org/reference/person-tv-credits)
    -   [ ] [Translations](https://developer.themoviedb.org/reference/translations)
-   [ ] Reviews
    -   [ ] [Details](https://developer.themoviedb.org/reference/review-details)
-   [ ] Search
    -   [x] ~~[Collection](https://developer.themoviedb.org/reference/search-collection)~~
    -   [ ] [Company](https://developer.themoviedb.org/reference/search-company): for v1
    -   [ ] [Keyword](https://developer.themoviedb.org/reference/search-keyword): for v1
    -   [x] ~~[Movie](https://developer.themoviedb.org/reference/search-movie)~~
    -   [ ] [Multi](https://developer.themoviedb.org/reference/search-multi): for v1
    -   [ ] [Person](https://developer.themoviedb.org/reference/search-person): for v1
    -   [x] ~~[TV](https://developer.themoviedb.org/reference/search-tv)~~
-   [x] ~~Trending~~
    -   [x] ~~[All](https://developer.themoviedb.org/reference/trending-all)~~
    -   [x] ~~[Movie](https://developer.themoviedb.org/reference/trending-movies)~~
    -   [x] ~~[TV](https://developer.themoviedb.org/reference/trending-tv)~~
    -   [x] ~~[People](https://developer.themoviedb.org/reference/trending-people)~~
-   [x] ~~TV Series List~~
    -   [x] ~~[Airing Today](https://developer.themoviedb.org/reference/tv-series-airing-today-list)~~
    -   [x] ~~[On The Air](https://developer.themoviedb.org/reference/tv-series-on-the-air-list)~~
    -   [x] ~~[Popular](https://developer.themoviedb.org/reference/tv-series-popular-list)~~
    -   [x] ~~[Top Rated](https://developer.themoviedb.org/reference/tv-series-top-rated-list)~~
-   [ ] TV Series
    -   [x] ~~[Details](https://developer.themoviedb.org/reference/tv-series-details)~~
    -   [ ] [Account States](https://developer.themoviedb.org/reference/tv-series-account-states)
    -   [ ] [Aggregate Credits](https://developer.themoviedb.org/reference/tv-series-aggregate-credits): for v1.5
    -   [ ] [Alternative Titles](https://developer.themoviedb.org/reference/tv-series-alternative-titles): for v1
    -   [ ] [Changes](https://developer.themoviedb.org/reference/tv-series-changes)
    -   [ ] [Content Ratings](https://developer.themoviedb.org/reference/tv-series-content-ratings)
    -   [ ] [Credits](https://developer.themoviedb.org/reference/tv-series-credits): for v1
    -   [ ] [Episode Groups](https://developer.themoviedb.org/reference/tv-series-episode-groups)
    -   [ ] [External IDs](https://developer.themoviedb.org/reference/tv-series-external-ids)
    -   [ ] [Images](https://developer.themoviedb.org/reference/tv-series-images)
    -   [ ] [Keywords](https://developer.themoviedb.org/reference/tv-series-keywords): for v1
    -   [ ] [Latest](https://developer.themoviedb.org/reference/tv-series-latest-id): for v1
    -   [ ] [List](https://developer.themoviedb.org/reference/lists-copy)
    -   [ ] [Recommendations](https://developer.themoviedb.org/reference/tv-series-recommendations): for v1
    -   [ ] [Reviews](https://developer.themoviedb.org/reference/tv-series-reviews): for v1
    -   [ ] [Screened Theatrically](https://developer.themoviedb.org/reference/tv-series-screened-theatrically)
    -   [ ] [Similar](https://developer.themoviedb.org/reference/tv-series-similar): for v1
    -   [ ] [Translations](https://developer.themoviedb.org/reference/tv-series-translations)
    -   [ ] [Videos](https://developer.themoviedb.org/reference/tv-series-videos): for v1
    -   [ ] [Watch Providers](https://developer.themoviedb.org/reference/tv-series-watch-providers)
    -   [ ] [Add Rating](https://developer.themoviedb.org/reference/tv-series-add-rating)
    -   [ ] [Delete Rating](https://developer.themoviedb.org/reference/tv-series-delete-rating)
-   [ ] TV Season
    -   [x] ~~[Details](https://developer.themoviedb.org/reference/tv-season-details)~~
    -   [ ] [Account States](https://developer.themoviedb.org/reference/tv-season-account-states)
    -   [ ] [Aggregate Credits](https://developer.themoviedb.org/reference/tv-season-aggregate-credits): for v1.5
    -   [ ] [Changes](https://developer.themoviedb.org/reference/tv-season-changes-by-id)
    -   [ ] [Credits](https://developer.themoviedb.org/reference/tv-season-credits): for v1
    -   [ ] [External IDs](https://developer.themoviedb.org/reference/tv-season-external-ids)
    -   [ ] [Images](https://developer.themoviedb.org/reference/tv-season-images)
    -   [ ] [Translations](https://developer.themoviedb.org/reference/tv-season-translations)
    -   [ ] [Videos](https://developer.themoviedb.org/reference/tv-season-videos): for v1
    -   [ ] [Watch Providers](https://developer.themoviedb.org/reference/tv-season-watch-providers)
-   [ ] TV Episode
    -   [x] ~~[Details](https://developer.themoviedb.org/reference/tv-episode-details)~~
    -   [ ] [Account States](https://developer.themoviedb.org/reference/tv-episode-account-states)
    -   [ ] [Changes](https://developer.themoviedb.org/reference/tv-episode-changes-by-id)
    -   [ ] [Credits](https://developer.themoviedb.org/reference/tv-episode-credits): for v1
    -   [ ] [External IDs](https://developer.themoviedb.org/reference/tv-episode-external-ids)
    -   [ ] [Images](https://developer.themoviedb.org/reference/tv-episode-images)
    -   [ ] [Translations](https://developer.themoviedb.org/reference/tv-episode-translations)
    -   [ ] [Videos](https://developer.themoviedb.org/reference/tv-episode-videos): for v1
    -   [ ] [Add Rating](https://developer.themoviedb.org/reference/tv-episode-add-rating)
    -   [ ] [Delete Rating](https://developer.themoviedb.org/reference/tv-episode-delete-rating)
-   [ ] TV Episode Group
    -   [ ] [Details](https://developer.themoviedb.org/reference/tv-episode-group-details)
-   [ ] Watch Providers
    -   [ ] [Available Regions](https://developer.themoviedb.org/reference/watch-providers-available-regions)
    -   [ ] [Movie Providers](https://developer.themoviedb.org/reference/watch-providers-movie-list)
    -   [ ] [TV Providers](https://developer.themoviedb.org/reference/watch-provider-tv-list)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

-   [TMDB](https://www.themoviedb.org/) for their awesome API
-   [`spatie`](https://github.com/spatie) for `spatie/package-skeleton-php`
-   [Ewilan Rivière](https://github.com/ewilan-riviere) author of this package
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

<p align="center">
    <img
        src="https://user-images.githubusercontent.com/48261459/201463225-0a5a084e-df15-4b11-b1d2-40fafd3555cf.svg"
        height="120rem"
        alt="https://github.com/kiwilan/php-tmdb"
    />
</p>

[version-src]: https://img.shields.io/packagist/v/kiwilan/php-tmdb.svg?style=flat&colorA=18181B&colorB=777BB4
[version-href]: https://packagist.org/packages/kiwilan/php-tmdb
[php-version-src]: https://img.shields.io/static/v1?style=flat&label=PHP&message=v8.1&color=777BB4&logo=php&logoColor=ffffff&labelColor=18181b
[php-version-href]: https://www.php.net/
[downloads-src]: https://img.shields.io/packagist/dt/kiwilan/php-tmdb.svg?style=flat&colorA=18181B&colorB=777BB4
[downloads-href]: https://packagist.org/packages/kiwilan/php-tmdb
[license-src]: https://img.shields.io/github/license/kiwilan/php-tmdb.svg?style=flat&colorA=18181B&colorB=777BB4
[license-href]: https://github.com/kiwilan/php-tmdb/blob/main/README.md
[tests-src]: https://img.shields.io/github/actions/workflow/status/kiwilan/php-tmdb/run-tests.yml?branch=main&label=tests&style=flat&colorA=18181B
[tests-href]: https://packagist.org/packages/kiwilan/php-tmdb
[codecov-src]: https://img.shields.io/codecov/c/gh/kiwilan/php-tmdb/main?style=flat&colorA=18181B&colorB=777BB4
[codecov-href]: https://codecov.io/gh/kiwilan/php-tmdb
