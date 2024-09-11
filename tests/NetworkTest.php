<?php

use Kiwilan\Tmdb\Tmdb;

it('can get network details', function () {
    $network = Tmdb::client(apiKey())
        ->networks()
        ->details(49);

    expect($network)->not()->toBeNull();
    expect($network->getId())->toBe(49);
    expect($network->getName())->toBe('HBO');
    expect($network->getOriginCountry())->toBe('US');
    expect($network->getHeadquarters())->toBe('New York City, New York');
    expect($network->getHomepage())->toBe('https://www.hbo.com');

    expect($network->getLogoPath())->toBeString();
    expect($network->getLogoUrl())->toBeString();
    expect($network->getLogoImage())->toBeString();

    $path = mediaPath('/logo-original.jpg');
    expect($network->saveLogoImage($path))->toBeTrue();
    expect(imageExists($path))->toBeTrue();
});
