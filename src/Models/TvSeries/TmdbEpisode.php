<?php

namespace Kiwilan\Tmdb\Models\TvSeries;

use DateTime;
use Kiwilan\Tmdb\Models\Common\TmdbVideo;
use Kiwilan\Tmdb\Models\Credits\TmdbCast;
use Kiwilan\Tmdb\Models\Credits\TmdbCrew;
use Kiwilan\Tmdb\Models\TmdbCredits;
use Kiwilan\Tmdb\Models\TmdbModel;
use Kiwilan\Tmdb\Traits;

/**
 * TV Series Episode
 */
class TmdbEpisode extends TmdbModel
{
    use Traits\TmdbId;
    use Traits\TmdbStill;
    use Traits\TmdbTmdbUrl;
    use Traits\TmdbTranslations;
    use Traits\TmdbVideos;
    use Traits\TmdbVotes;

    protected ?DateTime $air_date = null;

    /** @var TmdbCrew[]|null */
    protected ?array $crew = null;

    protected ?int $episode_tv_show_id = null;

    protected ?int $episode_season_number = null;

    protected ?int $episode_number = null;

    /** @var TmdbCast[]|null */
    protected ?array $cast = null;

    protected ?string $name = null;

    protected ?string $overview = null;

    protected ?string $production_code = null;

    protected ?int $runtime = null;

    protected ?int $season_number = null;

    protected ?TmdbCredits $credits = null;

    public function __construct(?array $data, ?int $episode_tv_show_id = null, ?int $episode_season_number = null)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->setId();
        $this->setStillPath();

        $this->air_date = $this->toDateTime('air_date');
        $this->episode_number = $this->toInt('episode_number');
        $this->name = $this->toString('name');
        $this->overview = $this->toString('overview');
        $this->production_code = $this->toString('production_code');
        $this->runtime = $this->toInt('runtime');
        $this->season_number = $this->toInt('season_number');
        $this->setVotes();

        $this->credits = new TmdbCredits([
            'cast' => $data['guest_stars'] ?? null,
            'crew' => $data['crew'] ?? null,
        ]);

        $this->episode_tv_show_id = $episode_tv_show_id;
        $this->episode_season_number = $episode_season_number;
        $this->translations = $this->parseTranslations();
        $this->videos = $this->validateData('videos', fn (array $values) => $this->loopOn($values['results'] ?? null, TmdbVideo::class));
    }

    public function getAirDate(): ?DateTime
    {
        return $this->air_date;
    }

    public function getEpisodeNumber(): ?int
    {
        return $this->episode_number;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getProductionCode(): ?string
    {
        return $this->production_code;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function getSeasonNumber(): ?int
    {
        return $this->season_number;
    }

    public function getCredits(): ?TmdbCredits
    {
        return $this->credits;
    }
}
