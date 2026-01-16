<?php

namespace Kiwilan\Tmdb\Repositories;

class ConfigurationRepository extends Repository
{
    /**
     * Get the list of languages (ISO 639-1 tags) used throughout TMDB.
     *
     * @docs https://developer.themoviedb.org/reference/configuration-languages
     *
     * @return \Kiwilan\Tmdb\Models\Common\TmdbLanguage[]
     */
    public function languages(): ?array
    {
        $response = $this->get('/configuration/languages');

        $items = [];
        if ($this->isSuccess && $response) {
            foreach ($response as $data) {
                $items[] = new \Kiwilan\Tmdb\Models\Common\TmdbLanguage($data);
            }
        }

        return $this->isSuccess ? $items : null;
    }

    /**
     * Get the list of countries (ISO 3166-1 tags) used throughout TMDB.
     *
     * @docs https://developer.themoviedb.org/reference/configuration-countries
     *
     * @return \Kiwilan\Tmdb\Models\Common\TmdbCountry[]
     */
    public function countries(): ?array
    {
        $response = $this->get('/configuration/countries', [
            'language' => $this->language,
        ]);

        $items = [];
        if ($this->isSuccess && $response) {
            foreach ($response as $data) {
                $items[] = new \Kiwilan\Tmdb\Models\Common\TmdbCountry($data);
            }
        }

        return $this->isSuccess ? $items : null;
    }
}
