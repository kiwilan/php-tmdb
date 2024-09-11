<?php

namespace Kiwilan\Tmdb\Models;

class TvSeries
{
    protected bool $adult = false;

    protected ?string $backdrop_path;

    protected ?array $episode_run_time;

    protected ?string $first_air_date;

    /** @var Genre[]|null */
    protected ?array $genres;

    protected ?string $homepage;

    protected ?int $id;

    protected bool $in_production = false;

    protected ?array $languages;

    protected ?string $last_air_date;

    protected ?TvSeries\EpisodeAir $last_episode_to_air;

    protected ?string $name;

    protected ?TvSeries\EpisodeAir $next_episode_to_air;

    /** @var TvSeries\Network[]|null */
    protected ?array $networks;

    protected ?int $number_of_episodes;

    protected ?int $number_of_seasons;

    /** @var string[]|null */
    protected ?array $origin_country;

    protected ?string $original_language;

    protected ?string $original_name;

    protected ?string $overview;

    protected ?float $popularity;

    protected ?string $poster_path;

    /** @var Company[]|null */
    protected ?array $production_companies;

    /** @var Country[]|null */
    protected ?array $production_countries;

    // /** @var TvShowSeason[]|null */
    // protected ?array $seasons;

    /** @var SpokenLanguage[]|null */
    protected ?array $spoken_languages;

    protected ?string $status;

    protected ?string $tagline;

    protected ?string $type;

    protected ?float $vote_average;

    protected ?int $vote_count;

    // protected ?AlternativeTitle $alternative_titles;

    // protected ?TvShowContentRatings $content_ratings;

    // protected ?TmdbCredits $credits;

    /** @var Credits\Crew[] */
    protected array $created_by = [];

    /** @var Search\SearchTvSeries[] */
    protected array $recommendations = [];

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
        $this->last_episode_to_air = new TvSeries\EpisodeAir($data['last_episode_to_air'] ?? null);
        $this->name = $data['name'] ?? null;
        $this->next_episode_to_air = new TvSeries\EpisodeAir($data['next_episode_to_air'] ?? null);
        $this->networks = [];
        if (isset($data['networks']) && is_array($data['networks'])) {
            foreach ($data['networks'] as $networkData) {
                $this->networks[] = new TvSeries\Network($networkData);
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
                // $this->production_companies[] = new ProductionCompany($companyData);
            }
        }
        $this->production_countries = [];
        if (isset($data['production_countries']) && is_array($data['production_countries'])) {
            foreach ($data['production_countries'] as $countryData) {
                // $this->production_countries[] = new ProductionCountry($countryData);
            }
        }
        // $this->seasons = [];
        if (isset($data['seasons']) && is_array($data['seasons'])) {
            foreach ($data['seasons'] as $seasonData) {
                // $this->seasons[] = new TvShowSeason($seasonData);
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
            // $this->alternative_titles = new AlternativeTitle($data['alternative_titles']);
        }

        if (isset($data['content_ratings'])) {
            // $this->content_ratings = new TvShowContentRatings($data['content_ratings']);
        }

        if (isset($data['credits'])) {
            // $this->credits = new Credits($data['credits']);
        }

        if (isset($data['recommendations'])) {
            $results = $data['recommendations']['results'] ?? [];
            $this->recommendations = [];
            foreach ($results as $recommendationData) {
                // $this->recommendations[] = new SearchMovieResult($recommendationData);
            }
        }

        if (isset($data['created_by'])) {
            $this->created_by = [];
            // foreach ($data['created_by'] as $creatorData) {
            //     $crew = new Crew($creatorData);
            //     $crew->job = 'Creator';
            //     $crew->department = 'Creator';
            //     $crew->order = 0;
            //     $this->created_by[] = $crew;
            // }
        }
    }
}
