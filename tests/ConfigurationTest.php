<?php

use Kiwilan\Tmdb\Models\Common\TmdbCountry;
use Kiwilan\Tmdb\Models\Common\TmdbLanguage;
use Kiwilan\Tmdb\Tmdb;

it('can get languages', function () {
    $languages = Tmdb::client(apiKey())
        ->language('fr-FR')
        ->configuration()
        ->languages();

    $first = reset($languages);
    expect($first)->not()->toBeNull();
    expect($first)->toBeInstanceOf(TmdbLanguage::class);

    $french = search_array($languages, 'getName', 'Français');
    expect($french)->toBeInstanceOf(TmdbLanguage::class);
    expect($french->getIsoCode())->toBe('fr');
    expect($french->getIso6391())->toBe('fr');
    expect($french->getEnglishName())->toBe('French');
    expect($french->getName())->toBe('Français');
});

it('can get countries', function () {
    $countries = Tmdb::client(apiKey())
        ->language('fr-FR')
        ->configuration()
        ->countries();

    $first = reset($countries);
    expect($first)->not()->toBeNull();
    expect($first)->toBeInstanceOf(TmdbCountry::class);

    $usa = search_array($countries, 'getEnglishName', 'United States of America');
    expect($usa)->toBeInstanceOf(TmdbCountry::class);
    expect($usa->getIsoCode())->toBe('US');
    expect($usa->getIso3166())->toBe('US');
    expect($usa->getEnglishName())->toBe('United States of America');
    expect($usa->getName())->toBe('United States of America');
    expect($usa->getNativeName())->toBe('United States');
});

function search_array(array $data, string $method, string $needle): mixed
{
    $id = null;
    foreach ($data as $key => $item) {
        if (! method_exists($item, $method) || ! is_callable([$item, $method])) {
            throw new Exception("Method {$method} not callable");
        }

        $value = call_user_func([$item, $method]);
        if ($value === $needle) {
            $id = $key;
        }
    }

    if (! $id) {
        return null;
    }

    return $data[$id];
}
