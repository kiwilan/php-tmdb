# Changelog

All notable changes to `php-tmdb` will be documented in this file.

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
