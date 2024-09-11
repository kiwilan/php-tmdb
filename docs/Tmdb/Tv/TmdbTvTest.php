<?php

use App\Facades\Kiwiflix;
use App\Facades\TmdbClient;
use Tmdb\Repository\TvRepository;

it('can search with api', function () {
    $data = TmdbClient::connect()->getTvApi()->getTvshow(94997, [
        'append_to_response' => 'alternative_titles,content_ratings,credits,recommendations',
    ]);

    expect($data['id'])->toBe(94997);
});

it('can fetch tv show House of the Dragon', function () {
    $repository = new TvRepository(TmdbClient::connect());

    /** @var \Tmdb\Model\Tv */
    $e = $repository->load('94997', [
    ]);

    $alternativeTitles = TmdbClient::loadAlternativeTitles($e);
    expect($alternativeTitles->french)->toBe('Maison du dragon');
    expect($alternativeTitles->english)->toBe('Game of Thrones: House of the Dragon');
    expect($alternativeTitles->original)->toBe('House of the Dragon');

    expect($e->getId())->toBe(94997);
});

it('can fetch tv show with guzzle', function () {
    $apiKey = Kiwiflix::tmdbApiKey();
    $series_id = '94997';
    $url = "https://api.themoviedb.org/3/tv/{$series_id}";

    $client = new \GuzzleHttp\Client;
    $response = $client->request('GET', $url, [
        'headers' => [
            'Authorization' => "Bearer {$apiKey}",
        ],
        'http_errors' => false,
    ]);
    $body = $response->getBody()->getContents();

    $body = json_decode($body, true);
    expect($body['id'])->toBe(94997);
});

it('can parse tv show', function () {
    $tv = TmdbClient::findTvShow('House of the Dragon', 2022);

    expect($tv)->not()->toBeNull();
    expect($tv->getId())->toBe(94997);
    expect($tv->getName())->toBe('House of the Dragon');
    expect($tv->getOriginalName())->toBe('House of the Dragon');
    expect($tv->getPosterPath())->toStartWith('/');
    expect($tv->getBackdropPath())->toStartWith('/');
    expect($tv->getOverview())->toBeString();
    expect($tv->getPopularity())->toBeFloat();
    expect($tv->getVoteAverage())->toBeFloat();
    expect($tv->getVoteCount())->toBeInt();
    expect($tv->getHomepage())->toBe('https://www.hbo.com/house-of-the-dragon');
    expect($tv->getOriginalLanguage())->toBe('en');
    expect($tv->getInProduction())->toBeBool();
    expect($tv->getType())->toBe('Scripted');
    expect($tv->getStatus())->toBeString();

    expect($tv->getNumberOfEpisodes())->toBeInt();
    expect($tv->getNumberOfSeasons())->toBeInt();

    expect($tv->getFirstAirDate()->format('Y-m-d'))->toBe('2022-08-21');
    expect($tv->getLastAirDate())->toBeInstanceOf(DateTime::class);
    expect($tv->getLastEpisodeToAir())->toBeInstanceOf(\Tmdb\Model\Tv\Episode::class);

    $origin_country = TmdbClient::loadOriginCountry($tv);
    expect($origin_country->getIso31661())->toBe('US');

    $networks = TmdbClient::loadNetworks($tv);
    expect($networks)->toBeArray();
    expect(count($networks))->toBe(1);

    $first = reset($networks);
    expect($first->getId())->toBe(49);
    expect($first->getName())->toBe('HBO');
    expect($first->getLogoPath())->toStartWith('/');
    expect($first->getOriginCountry())->toBe('US');

    $languages = TmdbClient::loadSpokenLanguages($tv);
    expect($languages)->toBeArray();
    expect(count($languages))->toBe(1);

    $first = reset($languages);
    expect($first->getIso6391())->toBe('en');
    expect($first->getName())->toBeNull();

    $content_rating = TmdbClient::loadContentRatings($tv);
    expect($content_rating->getIso31661())->toBe('US');
    expect($content_rating->getRating())->toBe('TV-MA');

    $created_by = TmdbClient::loadCreators($tv);
    expect($created_by)->toBeArray();
    expect(count($created_by))->toBe(2);

    $first = reset($created_by);
    expect($first->getId())->toBe(237053);
    expect($first->getName())->toBe('George R. R. Martin');
    expect($first->getProfilePath())->toStartWith('/');
    expect($first->getCreditId())->toBe('5db8d867a1d3320011e7ddf1');

    $companies = TmdbClient::loadCompanies($tv);
    expect($companies)->toBeArray();
    expect(count($companies))->toBe(4);

    $first = reset($companies);
    expect($first->getId())->toBe(3268);
    expect($first->getName())->toBe('HBO');
    expect($first->getLogoPath())->toStartWith('/');

    $recommendations = TmdbClient::loadRecommendations($tv);
    expect($recommendations)->toBeArray();
    expect(count($recommendations))->toBeGreaterThan(2);

    expect(reset($recommendations))->toBeInstanceOf(\Tmdb\Model\Tv::class);

    $similars = TmdbClient::loadSimilars($tv);
    expect($similars)->toBeArray();

    $cast = TmdbClient::loadCreditsCast($tv);
    expect($cast)->toBeArray();
    expect(reset($cast))->toBeInstanceOf(\Tmdb\Model\Person\CastMember::class);

    $crew = TmdbClient::loadCreditsCrew($tv);
    expect($crew)->toBeArray();
    expect(reset($crew))->toBeInstanceOf(\Tmdb\Model\Person\CrewMember::class);

    $alternativeTitles = TmdbClient::loadAlternativeTitles($tv);
    expect($alternativeTitles->french)->toBe('Maison du dragon');
    expect($alternativeTitles->english)->toBe('Game of Thrones: House of the Dragon');
    expect($alternativeTitles->original)->toBe('House of the Dragon');
    expect($alternativeTitles->has_alternative_titles)->toBeTrue();
});

it('can parse tv show season', function () {
    $tv = TmdbClient::findTvShow('House of the Dragon', 2022);

    $seasons = TmdbClient::loadSeasons($tv);
    expect($seasons)->toBeArray();
    expect(count($seasons))->toBeGreaterThan(2);

    $first = $seasons[1];
    expect($first)->not()->toBeNull();
    expect($first->getId())->toBe(134965);
    expect($first->getName())->toBe('Season 1');
    expect($first->getSeasonNumber())->toBe(1);
    expect($first->getAirDate()->format('Y-m-d'))->toBe('2022-08-20');
    expect($first->getOverview())->toBeString();
    expect($first->getPosterPath())->toStartWith('/');
    expect($first->getSeasonNumber())->toBeInt();

    $season = TmdbClient::loadSeason($tv->getId(), 1);

    expect($season)->toBeInstanceOf(\Tmdb\Model\Tv\Season::class);
    expect($season->getId())->toBe(134965);

    $episodes = TmdbClient::loadEpisodes($season);
    expect($episodes)->toBeArray();
    expect(count($episodes))->toBeGreaterThan(2);
    expect(reset($episodes))->toBeInstanceOf(\Tmdb\Model\Tv\Episode::class);

    $cast = TmdbClient::loadCreditsCast($season);
    expect($cast)->toBeArray();
    expect(reset($cast))->toBeInstanceOf(\Tmdb\Model\Person\CastMember::class);

    $crew = TmdbClient::loadCreditsCrew($season);
    expect($crew)->toBeArray();
    expect(reset($crew))->toBeInstanceOf(\Tmdb\Model\Person\CrewMember::class);
});

it('can parse tv show episode', function () {
    $tv = TmdbClient::findTvShow('House of the Dragon', 2022);

    $season = TmdbClient::loadSeason($tv->getId(), 1);
    $episodes = TmdbClient::loadEpisodes($season);

    expect($episodes)->toBeArray();
    expect(count($episodes))->toBeGreaterThan(2);

    $first = reset($episodes);
    expect($first)->not()->toBeNull();
    expect($first->getId())->toBe(1971015);
    expect($first->getName())->toBe('The Heirs of the Dragon');
    expect($first->getOverview())->toBeString();
    expect($first->getStillPath())->toStartWith('/');
    expect($first->getSeasonNumber())->toBeInt();
    expect($first->getEpisodeNumber())->toBeInt();
    expect($first->getVoteAverage())->toBeFloat();
    expect($first->getVoteCount())->toBeInt();
    expect($first->getShowId())->toBe(94997);

    expect($first->getAirDate()->format('Y-m-d'))->toBe('2022-08-21');

    $episode = TmdbClient::loadEpisode($tv->getId(), 1, 1);
    $cast = TmdbClient::loadCreditsCast($episode);
    expect($cast)->toBeArray();
    expect(reset($cast))->toBeInstanceOf(\Tmdb\Model\Person\CastMember::class);

    $crew = TmdbClient::loadCreditsCrew($episode);
    expect($crew)->toBeArray();
    expect(reset($crew))->toBeInstanceOf(\Tmdb\Model\Person\CrewMember::class);

    $creators = TmdbClient::loadCreators($tv);
    expect($creators)->toBeArray();
    expect(count($creators))->toBe(2);
});
