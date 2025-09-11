<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Models\TmdbModel;

/**
 * External IDs for TV show, season or episode.
 */
class TmdbExternalIds extends TmdbModel
{
    protected ?string $imdb_id = null;

    protected ?string $freebase_mid = null;

    protected ?string $freebase_id = null;

    protected ?int $tvdb_id = null;

    protected ?int $tvrage_id = null;

    protected ?string $wikidata_id = null;

    protected ?string $facebook_id = null;

    protected ?string $instagram_id = null;

    protected ?string $twitter_id = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        parent::__construct($data);

        $this->imdb_id = $this->toString('imdb_id');
        $this->freebase_mid = $this->toString('freebase_mid');
        $this->freebase_id = $this->toString('freebase_id');
        $this->tvdb_id = $this->toInt('tvdb_id');
        $this->tvrage_id = $this->toInt('tvrage_id');
        $this->wikidata_id = $this->toString('wikidata_id');
        $this->facebook_id = $this->toString('facebook_id');
        $this->instagram_id = $this->toString('instagram_id');
        $this->twitter_id = $this->toString('twitter_id');
    }

    /**
     * IDMB ID (e.g. tt1845307).
     */
    public function getImdbId(): ?string
    {
        return $this->imdb_id;
    }

    /**
     * Freebase MID (e.g. /m/0gtxh4v).
     */
    public function getFreebaseMid(): ?string
    {
        return $this->freebase_mid;
    }

    /**
     * Freebase ID (e.g. 9207a840-cb2c-4f15-b13a-02b2a8210d19).
     */
    public function getFreebaseId(): ?string
    {
        return $this->freebase_id;
    }

    /**
     * TVDB ID (e.g. 248741).
     */
    public function getTvdbId(): ?int
    {
        return $this->tvdb_id;
    }

    /**
     * TVRage ID (e.g. 28416).
     */
    public function getTvrageId(): ?int
    {
        return $this->tvrage_id;
    }

    /**
     * Wikidata ID (e.g. Q32488).
     */
    public function getWikidataId(): ?string
    {
        return $this->wikidata_id;
    }

    /**
     * Facebook ID (e.g. 2BrokeGirls).
     */
    public function getFacebookId(): ?string
    {
        return $this->facebook_id;
    }

    /**
     * Instagram ID (e.g. 2brokegirlscbs).
     */
    public function getInstagramId(): ?string
    {
        return $this->instagram_id;
    }

    /**
     * Twitter ID (e.g. 2BrokeGirls).
     */
    public function getTwitterId(): ?string
    {
        return $this->twitter_id;
    }
}
