<?php

namespace Kiwilan\Tmdb;

use App\Facades\Kiwiflix;
use Tmdb\Client;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\Request\AcceptJsonRequestListener;
use Tmdb\Event\Listener\Request\ApiTokenRequestListener;
use Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener;
use Tmdb\Event\Listener\Request\UserAgentRequestListener;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Token\Api\BearerToken;

/**
 * Based on `php-tmdb/api` package.
 *
 * @docs https://github.com/php-tmdb/api/blob/4.1/examples/setup-client.php
 */
class TmdbClient
{
    public static function make(): Client
    {
        $token = new BearerToken(Kiwiflix::tmdbApiKey());
        $ed = new \Symfony\Component\EventDispatcher\EventDispatcher;

        $client = new Client(
            [
                /** @var ApiToken|BearerToken */
                'api_token' => $token,
                'event_dispatcher' => [
                    'adapter' => $ed,
                ],
                // We make use of PSR-17 and PSR-18 auto discovery to automatically guess these, but preferably set these explicitly.
                'http' => [
                    'client' => null,
                    'request_factory' => null,
                    'response_factory' => null,
                    'stream_factory' => null,
                    'uri_factory' => null,
                ],
            ]
        );

        $requestListener = new RequestListener($client->getHttpClient(), $ed);
        $ed->addListener(RequestEvent::class, $requestListener);

        $apiTokenListener = new ApiTokenRequestListener($client->getToken());
        $ed->addListener(BeforeRequestEvent::class, $apiTokenListener);

        $acceptJsonListener = new AcceptJsonRequestListener;
        $ed->addListener(BeforeRequestEvent::class, $acceptJsonListener);

        $jsonContentTypeListener = new ContentTypeJsonRequestListener;
        $ed->addListener(BeforeRequestEvent::class, $jsonContentTypeListener);

        $userAgentListener = new UserAgentRequestListener;
        $ed->addListener(BeforeRequestEvent::class, $userAgentListener);

        return $client;
    }
}
