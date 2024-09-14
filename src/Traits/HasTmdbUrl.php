<?php

namespace Kiwilan\Tmdb\Traits;

trait HasTmdbUrl
{
    private function getBaseURL(): string
    {
        return 'https://www.themoviedb.org';
    }

    private function getMediaType(): string
    {
        // https://www.themoviedb.org/tv/1399-game-of-thrones/season/1/episode/1
        $slug = strtolower((new \ReflectionClass($this))->getShortName());

        return match ($slug) {
            'movie' => 'movie',
            'tvseries' => 'tv',
            'season' => 'season',
            'episode' => 'episode',
            'person' => 'person',
            'cast' => 'person',
            'crew' => 'person',
            default => 'unknown',
        };
    }

    public function getTmdbUrl(): ?string
    {
        if (! method_exists($this, 'getId')) {
            return null;
        }

        if ($this->getMediaType() === 'movie' || $this->getMediaType() === 'tv') {
            return "{$this->getBaseURL()}/{$this->getMediaType()}/{$this->getId()}";
        }

        if ($this->getMediaType() === 'season') {
            if (! property_exists($this, 'season_tv_show_id') && ! method_exists($this, 'getSeasonNumber')) {
                return null;
            }

            if (! $this->season_tv_show_id || ! $this->getSeasonNumber()) {  // @phpstan-ignore-line
                return null;
            }

            return "{$this->getBaseURL()}/tv/{$this->season_tv_show_id}/{$this->getMediaType()}/{$this->getSeasonNumber()}";
        }

        if ($this->getMediaType() === 'episode') {
            if (! property_exists($this, 'episode_tv_show_id') && ! property_exists($this, 'episode_season_number') && ! method_exists($this, 'getEpisodeNumber')) {
                return null;
            }

            if (! $this->episode_tv_show_id || ! $this->episode_season_number || ! $this->getEpisodeNumber()) {
                return null;
            }

            return "{$this->getBaseURL()}/tv/{$this->episode_tv_show_id}/season/{$this->episode_season_number}/{$this->getMediaType()}/{$this->getEpisodeNumber()}";
        }

        if ($this->getMediaType() === 'person') {
            return "{$this->getBaseURL()}/person/{$this->getId()}";
        }

        return null;
    }
}
