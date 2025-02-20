# Changelog

All notable changes to `php-tmdb` will be documented in this file.

## v0.1.06 - 2025-02-20

Add translations for `TmdbMovie`, `TmdbTvSeries`, `TmdbSeason` and `TmdbEpisode`.

## v0.1.05 - 2024-09-24

- Add collections methods `images()` and `translations()`
- Improve `TmdbModel` builtin methods to simplify all models constructors
- Remove `has` into traits name to simplify the code
- Move all images utils to `Utils\Images`, add static `fixUrl()` method to `TmdbUrl`
- Add some properties to improve `Repository`
- Add `raw()` method to execute raw request to TMDB API (for non implemented methods)

## v0.1.04 - 2024-09-24

- add `getRawDataKey(string $key)` to save extract data from raw data
- now all requests to API (except for images) have `'accept' => 'application/json'` header
- add `getFirstResult()`, `getLastResult()`, `filter(\Closure $closure)`, `find(\Closure $closure)` to `Results` to help filter results

## v0.1.02 - 2024-09-20

Add `getBelongsToCollection()` to `TmdbMovie`

## v0.1.01 - 2024-09-20

- add `getRawData()` method for all models to get raw data from TMDB API
- add `__set()` method for all models to update model properties
- delete `TmdbBelongsToCollection` model and use only `TmdbCollection` model, now `getBelongsToCollection()` is replaced by `getCollection()`
- add `getMedia()` for `TmdbMedia` model to get media data which can be movie, tv show, or person

## v0.1.0 - 2024-09-18

- Rename all models with `Tmdb` prefix to avoid conflicts with other models
- Improve `trending/all` endpoint with new model `TmbdMedia` to add `Person` type

## v0.0.38 - 2024-09-17

- Replace traits names with `Tmdb` prefix to avoid conflicts with other libraries
- Use `guzzle` to download images

## v0.0.37 - 2024-09-14

Add `getTmdbUrl()` for collections

## v0.0.36 - 2024-09-14

- Add `getTmdbUrl()` for movies, tv shows, seasons, episodes, and people.
- Add `getVotePercentage()` for all models with `vote_average` entry to get vote percentage.

## v0.0.35 - 2024-09-13

Some fixes

## v0.0.34 - 2024-09-13

Fix on results if null.

## v0.0.33 - 2024-09-13

Some fixes

## v0.0.32 - 2024-09-12

- Episode has now `credits()` instead `cast()` and `crew()` for consistency
- Movie has now `getReleaseDatesSpecific()` instead `getReleaseDateSpecific()` for consistency, add `getContentRatingSpecific()` to get content rating for specific country

## v0.0.31 - 2024-09-12

- Add Movie Lists
- Add Trending
- Add TV Series List

## v0.0.3 - 2024-09-12

Now `append_to_response` parameter is an array of strings.

## v0.0.2 - 2024-09-11

- Add more API methods
- Add repositories

## v0.0.1 - 2024-09-11

init
