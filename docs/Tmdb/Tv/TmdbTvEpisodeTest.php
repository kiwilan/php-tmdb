<?php

use App\Facades\Kiwiflix;
use App\Facades\TmdbClient;
use Tmdb\Model\Person\CastMember;
use Tmdb\Model\Person\CrewMember;
use Tmdb\Model\Person\GuestStar;
use Tmdb\Model\Tv\Episode;
use Tmdb\Repository\TvEpisodeRepository;

it('can fetch episode House of the Dragon S02 E06', function () {
    $repository = new TvEpisodeRepository(TmdbClient::connect());

    /** @var Episode */
    $e = $repository->load('94997', '2', '5', [
        'append_to_response' => 'credits',
    ]);

    $credits = $e->getCredits();
    $cast = $credits->getCast()->toArray();
    $crew = $credits->getCrew()->toArray();
    $guest = $credits->getGuestStars()->toArray();

    expect($e->getId())->toBe(5234726);

    expect(reset($cast))->toBeInstanceOf(CastMember::class);
    expect(reset($crew))->toBeInstanceOf(CrewMember::class);
    expect(reset($guest))->toBeInstanceOf(GuestStar::class);
});

it('can fetch episode with guzzle', function () {
    $apiKey = Kiwiflix::tmdbApiKey();
    $series_id = '94997';
    $season_number = '2';
    $episode_number = '5';
    $url = "https://api.themoviedb.org/3/tv/{$series_id}/season/{$season_number}/episode/{$episode_number}";

    $client = new \GuzzleHttp\Client;
    $response = $client->request('GET', $url, [
        'headers' => [
            'Authorization' => "Bearer {$apiKey}",
        ],
        'http_errors' => false,
    ]);
    $body = $response->getBody()->getContents();

    $body = json_decode($body, true);
    expect($body['id'])->toBe(5234726);
});
