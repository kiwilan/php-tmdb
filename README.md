# PHP TMDB

![Banner with eReader picture in background and PHP eBook title](https://raw.githubusercontent.com/kiwilan/php-tmdb/main/docs/banner.jpg)

[![php][php-version-src]][php-version-href]
[![version][version-src]][version-href]
[![downloads][downloads-src]][downloads-href]
[![license][license-src]][license-href]
[![tests][tests-src]][tests-href]
[![codecov][codecov-src]][codecov-href]

PHP wrapper package to interact with the [The Movie Database (TMDB) API](https://www.themoviedb.org/documentation/api).

> [!IMPORTANT]
> You need to create an account on [TMDB](https://www.themoviedb.org/) and get an **_API key_** to use this package. It's free and easy to do, you can read [this guide](https://developer.themoviedb.org/docs/getting-started) to get started.

_Why this package? All current PHP packages to interact with the TMDB API are not up-to-date and I need a modern and easy-to-use package to interact with the TMDB API. So I decided to create this package. You can check [Roadmap](#roadmap) to see what I plan to do with this package._

> [!WARNING]
> This package is under development.

## Requirements

PHP 8.1 and later.

## Features

-   🔍 Search Movie and TV Series
-   🎬 Get Movie and TV Series details
-   🖼️ Get Movie and TV Series poster and background

## Installation

You can install the package via composer:

```bash
composer require kiwilan/php-tmdb
```

## Usage

### Search

Search a movie by title:

```php
use Kiwilan\Tmdb\Tmdb;

$results = Tmdb::client('API_KEY')->searchMovie('the fellowship of the ring');
$movies = $results->getResults(); // \Kiwilan\Tmdb\Models\Movie[]
$firstMovie = $results->getFirstResult(); // \Kiwilan\Tmdb\Models\Movie
```

Search a TV series by title:

```php
use Kiwilan\Tmdb\Tmdb;

$results = Tmdb::client('API_KEY')->searchTv('game of thrones');
$tvSeries = $results->getResults(); // \Kiwilan\Tmdb\Models\TvSeries[]
$firstTvSeries = $results->getFirstResult(); // \Kiwilan\Tmdb\Models\TvSeries
```

## Testing

```bash
composer test
```

## Contributing

A fix? A new feature? A typo? You're welcome to contribute to this project. Just open a pull request.

### Roadmap

-   [Account](https://developer.themoviedb.org/reference/account-details): not planned
-   [Authentication](https://developer.themoviedb.org/reference/authentication-create-guest-session): not planned
-   [ ] Certifications
    -   [ ] [Movie Certifications](https://developer.themoviedb.org/reference/certification-movie-list)
    -   [ ] [TV Certifications](https://developer.themoviedb.org/reference/certifications-tv-list)
-   [ ] Changes
    -   [ ] [Movie List](https://developer.themoviedb.org/reference/changes-movie-list)
    -   [ ] [People List](https://developer.themoviedb.org/reference/changes-people-list)
    -   [ ] [TV List](https://developer.themoviedb.org/reference/changes-tv-list)
-   [ ] Collections
    -   [ ] [Details](https://developer.themoviedb.org/reference/collection-details)
    -   [ ] [Images](https://developer.themoviedb.org/reference/collection-images)
    -   [ ] [Translations](https://developer.themoviedb.org/reference/collection-translations)
-   [ ] Companies
    -   [ ] [Details](https://developer.themoviedb.org/reference/company-details)
    -   [ ] [Alternative Names](https://developer.themoviedb.org/reference/company-alternative-names)
    -   [ ] [Images](https://developer.themoviedb.org/reference/company-images)
-   [Configuration](https://developer.themoviedb.org/reference/configuration-details): not planned
-   [ ] Credits
    -   [ ] [Details](https://developer.themoviedb.org/reference/credit-details)
-   [ ] Discover
    -   [ ] [Movie](https://developer.themoviedb.org/reference/discover-movie)
    -   [ ] [TV](https://developer.themoviedb.org/reference/discover-tv)
-   [ ] Find
    -   [ ] [By ID](https://developer.themoviedb.org/reference/find-by-id)
-   [ ] Genres
    -   [ ] [Movie List](https://developer.themoviedb.org/reference/genre-movie-list)
    -   [ ] [TV List](https://developer.themoviedb.org/reference/genre-tv-list)
-   [Guest Sessions](https://developer.themoviedb.org/reference/guest-session-rated-movies): not planned
-   [Keywords](https://developer.themoviedb.org/reference/keyword-list): not planned
-   [Lists](https://developer.themoviedb.org/reference/list-add-movie): not planned
-   [ ] Movie Lists
    -   [ ] [Now playing](https://developer.themoviedb.org/reference/movie-now-playing-list)
    -   [ ] [Popular](https://developer.themoviedb.org/reference/movie-popular-list)
    -   [ ] [Top Rated](https://developer.themoviedb.org/reference/movie-top-rated-list)
    -   [ ] [Upcoming](https://developer.themoviedb.org/reference/movie-upcoming-list)
-   [ ] Movies
    -   [ ] [Details](https://developer.themoviedb.org/reference/movie-details)
    -   [ ] [Account States](https://developer.themoviedb.org/reference/movie-account-states)
    -   [ ] [Alternative Titles](https://developer.themoviedb.org/reference/movie-alternative-titles)
    -   [ ] [Changes](https://developer.themoviedb.org/reference/movie-changes)
    -   [ ] [Credits](https://developer.themoviedb.org/reference/movie-credits)

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
