<?php

namespace Kiwilan\Tmdb\Models;

class TvSeries
{
    public bool $adult = false;

    public ?string $backdrop_path;

    public ?array $episode_run_time;

    public ?string $first_air_date;

    /** @var Genre[]|null */
    public ?array $genres;

    public ?string $homepage;

    public ?int $id;

    public bool $in_production = false;

    public ?array $languages;

    public ?string $last_air_date;

    public ?EpisodeAir $last_episode_to_air;

    public ?string $name;

    public ?EpisodeAir $next_episode_to_air;

    /** @var Network[]|null */
    public ?array $networks;

    public ?int $number_of_episodes;

    public ?int $number_of_seasons;

    /** @var string[]|null */
    public ?array $origin_country;

    public ?string $original_language;

    public ?string $original_name;

    public ?string $overview;

    public ?float $popularity;

    public ?string $poster_path;

    /** @var ProductionCompany[]|null */
    public ?array $production_companies;

    /** @var ProductionCountry[]|null */
    public ?array $production_countries;

    /** @var TvShowSeason[]|null */
    public ?array $seasons;

    /** @var SpokenLanguage[]|null */
    public ?array $spoken_languages;

    public ?string $status;

    public ?string $tagline;

    public ?string $type;

    public ?float $vote_average;

    public ?int $vote_count;

    public ?AlternativeTitle $alternative_titles;

    public ?TvShowContentRatings $content_ratings;

    public ?TmdbCredits $credits;

    /** @var Crew[] */
    public array $created_by = [];

    /** @var SearchMovieResult[] */
    public array $recommendations = [];

    public function __construct(array $data)
    {
        $this->adult = $data['adult'] ?? false;
        $this->backdrop_path = $data['backdrop_path'] ?? null;
        $this->episode_run_time = $data['episode_run_time'] ?? null;
        $this->first_air_date = $data['first_air_date'] ?? null;
        $this->genres = [];
        if (isset($data['genres']) && is_array($data['genres'])) {
            foreach ($data['genres'] as $genreData) {
                $this->genres[] = new Genre($genreData);
            }
        }
        $this->homepage = $data['homepage'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->in_production = $data['in_production'] ?? false;
        $this->languages = $data['languages'] ?? null;
        $this->last_air_date = $data['last_air_date'] ?? null;
        $this->last_episode_to_air = new EpisodeAir($data['last_episode_to_air'] ?? null);
        $this->name = $data['name'] ?? null;
        $this->next_episode_to_air = new EpisodeAir($data['next_episode_to_air'] ?? null);
        $this->networks = [];
        if (isset($data['networks']) && is_array($data['networks'])) {
            foreach ($data['networks'] as $networkData) {
                $this->networks[] = new Network($networkData);
            }
        }
        $this->number_of_episodes = $data['number_of_episodes'] ?? null;
        $this->number_of_seasons = $data['number_of_seasons'] ?? null;
        $this->origin_country = $data['origin_country'] ?? null;
        $this->original_language = $data['original_language'] ?? null;
        $this->original_name = $data['original_name'] ?? null;
        $this->overview = $data['overview'] ?? null;
        $this->popularity = $data['popularity'] ?? null;
        $this->poster_path = $data['poster_path'] ?? null;
        $this->production_companies = [];
        if (isset($data['production_companies']) && is_array($data['production_companies'])) {
            foreach ($data['production_companies'] as $companyData) {
                $this->production_companies[] = new ProductionCompany($companyData);
            }
        }
        $this->production_countries = [];
        if (isset($data['production_countries']) && is_array($data['production_countries'])) {
            foreach ($data['production_countries'] as $countryData) {
                $this->production_countries[] = new ProductionCountry($countryData);
            }
        }
        $this->seasons = [];
        if (isset($data['seasons']) && is_array($data['seasons'])) {
            foreach ($data['seasons'] as $seasonData) {
                $this->seasons[] = new TvShowSeason($seasonData);
            }
        }
        $this->spoken_languages = [];
        if (isset($data['spoken_languages']) && is_array($data['spoken_languages'])) {
            foreach ($data['spoken_languages'] as $languageData) {
                $this->spoken_languages[] = new SpokenLanguage($languageData);
            }
        }
        $this->status = $data['status'] ?? null;
        $this->tagline = $data['tagline'] ?? null;
        $this->type = $data['type'] ?? null;
        $this->vote_average = $data['vote_average'] ?? null;
        $this->vote_count = $data['vote_count'] ?? null;

        if (isset($data['alternative_titles'])) {
            $this->alternative_titles = new AlternativeTitle($data['alternative_titles']);
        }

        if (isset($data['content_ratings'])) {
            $this->content_ratings = new TvShowContentRatings($data['content_ratings']);
        }

        if (isset($data['credits'])) {
            $this->credits = new Credits($data['credits']);
        }

        if (isset($data['recommendations'])) {
            $results = $data['recommendations']['results'] ?? [];
            $this->recommendations = [];
            foreach ($results as $recommendationData) {
                $this->recommendations[] = new SearchMovieResult($recommendationData);
            }
        }

        if (isset($data['created_by'])) {
            $this->created_by = [];
            foreach ($data['created_by'] as $creatorData) {
                $crew = new Crew($creatorData);
                $crew->job = 'Creator';
                $crew->department = 'Creator';
                $crew->order = 0;
                $this->created_by[] = $crew;
            }
        }
    }
}
