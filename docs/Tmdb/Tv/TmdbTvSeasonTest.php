<?php

use App\Facades\Kiwiflix;
use App\Facades\TmdbClient;
use Tmdb\Repository\TvSeasonRepository;

it('can fetch season House of the Dragon S02', function () {
    $repository = new TvSeasonRepository(TmdbClient::connect());

    /** @var \Tmdb\Model\Tv\Season */
    $s = $repository->load('94997', '2', [
    ]);

    expect($s->getId())->toBe(368014);
});

it('can fetch season House of the Dragon S02 with Facade', function () {
    $season = TmdbClient::loadSeason(94997, 2);

    expect($season->getId())->toBe(368014);
});

it('can fetch season with guzzle', function () {
    $apiKey = Kiwiflix::tmdbApiKey();
    $series_id = '94997';
    $season_number = '2';
    $url = "https://api.themoviedb.org/3/tv/{$series_id}/season/{$season_number}";

    $client = new \GuzzleHttp\Client;
    $response = $client->request('GET', $url, [
        'headers' => [
            'Authorization' => "Bearer {$apiKey}",
        ],
        'http_errors' => false,
    ]);
    $body = $response->getBody()->getContents();

    $body = json_decode($body, true);
    expect($body['id'])->toBe(368014);
});

it('can parse tv show season', function () {
    $tv = TmdbClient::findTvShow('House of the Dragon', 2022);

    $seasons = TmdbClient::loadSeasons($tv);
    expect($seasons)->not()->toBeNull();
    expect($seasons)->toBeArray();
    expect($seasons)->toHaveCount(3);

    $first = reset($seasons);
    expect($first->getId())->toBe(309556);
    expect($first->getSeasonNumber())->toBe(0);
    expect($first->getName())->toBe('Specials');

    $season = TmdbClient::loadSeason($tv->getId(), 1, true);
    $episodes = TmdbClient::loadEpisodes($season);
    expect($episodes)->not()->toBeNull();
    expect($episodes)->toBeArray();
    expect($episodes)->toBeGreaterThan(10);

    $first = reset($episodes);
    expect(TmdbClient::loadCreditsCast($first))->not()->toBeNull();
});
