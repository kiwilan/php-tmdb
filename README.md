# PHP TMDB

![Banner with eReader picture in background and PHP eBook title](https://raw.githubusercontent.com/kiwilan/php-tmdb/main/docs/banner.jpg)

[![php][php-version-src]][php-version-href]
[![version][version-src]][version-href]
[![downloads][downloads-src]][downloads-href]
[![license][license-src]][license-href]
[![tests][tests-src]][tests-href]
[![codecov][codecov-src]][codecov-href]

PHP wrapper package to interact with the [The Movie Database (TMDB) API](https://www.themoviedb.org/documentation/api).

_This is NOT official TMDB API PHP wrapper, you can check [php-tmdb/api](https://github.com/php-tmdb/api) if you want official package._

> [!IMPORTANT]
> You need to create an account on [TMDB](https://www.themoviedb.org/) and get an **_API key_** to use this package. It's free and easy to do, you can read [this guide](https://developer.themoviedb.org/docs/getting-started) to get started.

_Why this package? All current PHP packages to interact with the TMDB API are not up-to-date and I need a modern and easy-to-use package to interact with the TMDB API. So I decided to create this package. You can check [Roadmap](#roadmap) to see what I plan to do with this package._

> [!WARNING]
> This package is under development.

## Requirements

**PHP 8.1** and later.

> [!NOTE]
> Package `guzzlehttp/guzzle` will be installed automatically by Composer.

## Features

-   🔍 Search Collections, Movies, TV Series
-   🎬 Collections, Movies, Networks, TV Series, TV seasons, TV episodes details
-   🖼️ Posters, backgrounds, logos, profiles, stills with included methods
-   🗄️ TMDB models: `AlternativeTitle`, `Collection`, `Company`, `ContentRating`, `Country`, `Credits` (with `Cast`<sup>1</sup> & `Crew`), `Episode`, `Genre`, `Movie`, `Network`, `ReleaseDate`, `Season`, `SpokenLanguage`, `TvSeries`

<sup>1</sup>: Guest stars are included into `Cast`.

## Installation

You can install the package via composer:

```bash
composer require kiwilan/php-tmdb
```

## Usage

### Collection

#### Details

From <https://developer.themoviedb.org/reference/collection-details>

```php
use Kiwilan\Tmdb\Tmdb;

$collection = Tmdb::client('API_KEY')
    ->collections()
    ->details(collection_id: 119); // ?\Kiwilan\Tmdb\Models\Collection
```

### Movies

#### Details

From <https://developer.themoviedb.org/reference/movie-details>

```php
use Kiwilan\Tmdb\Tmdb;

$movie = Tmdb::client('API_KEY')
    ->movies()
    ->details(movie_id: 120); // ?\Kiwilan\Tmdb\Models\Movie
```

You can use `append_to_response` option to get more details:

```php
use Kiwilan\Tmdb\Tmdb;

$movie = Tmdb::client('API_KEY')
    ->movies()
    ->details(movie_id: 120, append_to_response: 'credits,recommendations'); // ?\Kiwilan\Tmdb\Models\Movie
```

### Networks

#### Details

From <https://developer.themoviedb.org/reference/network-details>

```php
use Kiwilan\Tmdb\Tmdb;

$network = Tmdb::client('API_KEY')
    ->networks()
    ->details(network_id:49); // ?\Kiwilan\Tmdb\Models\TvSeries\Network
```

### Search

#### Collection

From <https://developer.themoviedb.org/reference/search-collection>

```php
use Kiwilan\Tmdb\Tmdb;

$results = Tmdb::client('API_KEY')
    ->search()
    ->movie(query: 'the lord of the rings');

$collections = $results->getResults(); // \Kiwilan\Tmdb\Models\Collection[]
$firstCollection = $results->getFirstResult(); // ?\Kiwilan\Tmdb\Models\Collection
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

#### Movie

From <https://developer.themoviedb.org/reference/search-movie>

```php
use Kiwilan\Tmdb\Tmdb;

$results = Tmdb::client('API_KEY')
    ->search()
    ->movie(query:'the fellowship of the ring');

$movies = $results->getResults(); // \Kiwilan\Tmdb\Models\Movie[]
$firstMovie = $results->getFirstResult(); // ?\Kiwilan\Tmdb\Models\Movie
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

#### TV

From <https://developer.themoviedb.org/reference/search-tv>

```php
use Kiwilan\Tmdb\Tmdb;

$results = Tmdb::client('API_KEY')
    ->search()
    ->tv(query: 'game of thrones');

$tvSeries = $results->getResults(); // \Kiwilan\Tmdb\Models\TvSeries[]
$firstTvSeries = $results->getFirstResult(); // ?\Kiwilan\Tmdb\Models\TvSeries
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

### TV Series

#### Details

From <https://developer.themoviedb.org/reference/tv-series-details>

```php
use Kiwilan\Tmdb\Tmdb;

$tvSeries = Tmdb::client('API_KEY')
    ->tvSeries()
    ->details(series_id: 1399); // ?\Kiwilan\Tmdb\Models\TvSeries
```

You can use `append_to_response` option to get more details:

```php
use Kiwilan\Tmdb\Tmdb;

$tvSeries = Tmdb::client('API_KEY')
    ->tvSeries()
    ->details(series_id: 1399, append_to_response: 'credits,recommendations'); // ?\Kiwilan\Tmdb\Models\TvSeries
```

### TV Seasons

#### Details

From <https://developer.themoviedb.org/reference/tv-season-details>

```php
use Kiwilan\Tmdb\Tmdb;

$season = Tmdb::client('API_KEY')
    ->tvSeasons()
    ->details(series_id: 1399, season_number: 1); // ?\Kiwilan\Tmdb\Models\Season
```

You can use `append_to_response` option to get more details:

```php
use Kiwilan\Tmdb\Tmdb;

$season = Tmdb::client('API_KEY')
    ->tvSeasons()
    ->details(series_id: 1399, season_number: 1, append_to_response: 'credits'); // ?\Kiwilan\Tmdb\Models\Season
```

### TV Episodes

#### Details

From <https://developer.themoviedb.org/reference/tv-episode-details>

```php
use Kiwilan\Tmdb\Tmdb;

$episode = Tmdb::client('API_KEY')
    ->tvEpisodes()
    ->details(series_id: 1399, season_number: 1, episode_number: 1); // ?\Kiwilan\Tmdb\Models\Episode
```

You can use `append_to_response` option to get more details:

```php
use Kiwilan\Tmdb\Tmdb;

$episode = Tmdb::client('API_KEY')
    ->tvEpisodes()
    ->details(series_id: 1399, season_number: 1, episode_number: 1, append_to_response: 'credits'); // ?\Kiwilan\Tmdb\Models\Episode
```

## Images

For any model with image (poster, backdrop, logo, profile, still), you can use multiple methods:

```php
use Kiwilan\Tmdb\Tmdb;

$movie = Tmdb::client('API_KEY')
    ->movies()
    ->details(movie_id: 120); // ?\Kiwilan\Tmdb\Models\Movie

$poster_path = $movie->getPosterPath(); // string|null (path to poster)
$poster_url = $movie->getPosterUrl(); // string|null (URL to poster)
$poster_image = $movie->getPosterImage(); // string|null (binary image)
$success = $movie->savePosterImage('path/to/save/poster.jpg'); // bool (true if success)
```

You can change the size of the image with `size` option, available for `get*Url`, `get*Image` and `save*Image` methods:

```php
use Kiwilan\Tmdb\Tmdb;

$movie = Tmdb::client('API_KEY')
    ->movies()
    ->details(movie_id: 120); // ?\Kiwilan\Tmdb\Models\Movie

$poster_path = $movie->getPosterUrl(size: PosterSize::W500); // string|null (path to poster)
```

These methods are available for `Poster`, `Backdrop`, `Logo`, `Profile` and `Still`.

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
-   [ ] Collections
    -   [x] [Details](https://developer.themoviedb.org/reference/collection-details): for v1
    -   [ ] [Images](https://developer.themoviedb.org/reference/collection-images)
    -   [ ] [Translations](https://developer.themoviedb.org/reference/collection-translations)
-   [ ] Companies
    -   [x] [Details](https://developer.themoviedb.org/reference/company-details): for v1
    -   [ ] [Alternative Names](https://developer.themoviedb.org/reference/company-alternative-names)
    -   [ ] [Images](https://developer.themoviedb.org/reference/company-images)
-   [ ] [Configuration](https://developer.themoviedb.org/reference/configuration-details)
-   [x] Credits
    -   [x] [Details](https://developer.themoviedb.org/reference/credit-details)
-   [ ] Discover
    -   [ ] [Movie](https://developer.themoviedb.org/reference/discover-movie)
    -   [ ] [TV](https://developer.themoviedb.org/reference/discover-tv)
-   [ ] Find
    -   [ ] [By ID](https://developer.themoviedb.org/reference/find-by-id)
-   [ ] Genres
    -   [ ] [Movie List](https://developer.themoviedb.org/reference/genre-movie-list)
    -   [ ] [TV List](https://developer.themoviedb.org/reference/genre-tv-list)
-   [ ] [Guest Sessions](https://developer.themoviedb.org/reference/guest-session-rated-movies)
-   [ ] [Keywords](https://developer.themoviedb.org/reference/keyword-list)
-   [ ] [Lists](https://developer.themoviedb.org/reference/list-add-movie)
-   [ ] Movie Lists
    -   [ ] [Now playing](https://developer.themoviedb.org/reference/movie-now-playing-list): for v1
    -   [ ] [Popular](https://developer.themoviedb.org/reference/movie-popular-list): for v1
    -   [ ] [Top Rated](https://developer.themoviedb.org/reference/movie-top-rated-list): for v1
    -   [ ] [Upcoming](https://developer.themoviedb.org/reference/movie-upcoming-list): for v1
-   [ ] Movies
    -   [x] [Details](https://developer.themoviedb.org/reference/movie-details): for v1
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
    -   [x] [Details](https://developer.themoviedb.org/reference/network-details): for v1
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
    -   [x] [Collection](https://developer.themoviedb.org/reference/search-collection): for v1
    -   [ ] [Company](https://developer.themoviedb.org/reference/search-company): for v1
    -   [ ] [Keyword](https://developer.themoviedb.org/reference/search-keyword): for v1
    -   [x] [Movie](https://developer.themoviedb.org/reference/search-movie): for v1
    -   [ ] [Multi](https://developer.themoviedb.org/reference/search-multi): for v1
    -   [ ] [Person](https://developer.themoviedb.org/reference/search-person): for v1
    -   [x] [TV](https://developer.themoviedb.org/reference/search-tv): for v1
-   [ ] Trending
    -   [ ] [All](https://developer.themoviedb.org/reference/trending-all): for v1.5
    -   [ ] [Movie](https://developer.themoviedb.org/reference/trending-movie): for v1.5
    -   [ ] [TV](https://developer.themoviedb.org/reference/trending-tv): for v1.5
    -   [ ] [Person](https://developer.themoviedb.org/reference/trending-person): for v1.5
-   [ ] TV Series List
    -   [ ] [Airing Today](https://developer.themoviedb.org/reference/tv-series-airing-today-list): for v1.5
    -   [ ] [On The Air](https://developer.themoviedb.org/reference/tv-series-on-the-air-list): for v1.5
    -   [ ] [Popular](https://developer.themoviedb.org/reference/tv-series-popular-list): for v1.5
    -   [ ] [Top Rated](https://developer.themoviedb.org/reference/tv-series-top-rated-list): for v1.5
-   [ ] TV Series
    -   [x] [Details](https://developer.themoviedb.org/reference/tv-series-details): for v1
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
    -   [x] [Details](https://developer.themoviedb.org/reference/tv-season-details): for v1
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
    -   [x] [Details](https://developer.themoviedb.org/reference/tv-episode-details): for v1
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
