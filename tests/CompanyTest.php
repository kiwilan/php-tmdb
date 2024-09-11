<?php

use Kiwilan\Tmdb\Tmdb;

it('can get company details', function () {
    $company = Tmdb::client(apiKey())
        ->companies()
        ->details(12);

    expect($company)->not()->toBeNull();
    expect($company->getId())->toBe(12);
    expect($company->getLogoPath())->toBeString();
    expect($company->getName())->toBe('New Line Cinema');
    expect($company->getOriginCountry())->toBe('US');
});
