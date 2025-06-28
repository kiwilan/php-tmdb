<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Models\Common\TmdbVideo;

trait TmdbVideos
{
    /** @var TmdbVideo[]|null */
    protected ?array $videos = null;

    /**
     * Get movie videos, `videos` must be requested.
     *
     * @return TmdbVideo[]|null
     */
    public function getVideos(): ?array
    {
        return $this->videos;
    }

    /**
     * Get first teaser video, `videos` must be requested.
     *
     * Teaser video is a video with type `Teaser`, if there is no teaser video, it will return `null`.
     */
    public function getVideoTeaser(): ?TmdbVideo
    {
        return $this->getVideoType('Teaser');
    }

    /**
     * Get first trailer video, `videos` must be requested.
     *
     * Teaser video is a video with type `Trailer`, if there is no trailer video, it will return `null`.
     */
    public function getVideoTrailer(): ?TmdbVideo
    {
        return $this->getVideoType('Trailer');
    }

    /**
     * Try to get first promo video, `videos` must be requested.
     *
     * Promo video is a video with type `Trailer` or `Teaser`, if there is none, try first video or return `null`.
     */
    public function getVideoPromo(): ?TmdbVideo
    {
        $video = $this->getVideoType('Trailer');

        if (! $video) {
            $video = $this->getVideoType('Teaser');
        }

        if (! $video) {
            $videos = $this->getVideos();
            if (! empty($videos)) {
                $video = $videos[0];
            }
        }

        return $video;
    }

    /**
     * Get first video by type, `videos` must be requested.
     *
     * @param  string  $type  Video type to search for, e.g. 'Teaser', 'Trailer', etc.
     */
    public function getVideoType(string $type): ?TmdbVideo
    {
        if (! $this->videos || empty($this->videos)) {
            return null;
        }

        foreach ($this->videos as $video) {
            if ($video->getType() === $type) {
                return $video;
            }
        }

        return null;
    }
}
