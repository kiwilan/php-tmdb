<?php

use Kiwilan\Tmdb\Tmdb;

it('can get credits details', function () {
    $company = Tmdb::client(apiKey())->getCompany(12);

    expect($company)->not()->toBeNull();
    expect($company->getId())->toBe(12);
    expect($company->getLogoPath())->toBeString();
    expect($company->getName())->toBe('New Line Cinema');
    expect($company->getOriginCountry())->toBe('US');
});
