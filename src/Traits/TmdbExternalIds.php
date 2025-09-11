<?php

namespace Kiwilan\Tmdb\Traits;

use Kiwilan\Tmdb\Models\Common\TmdbExternalIds as CommonTmdbExternalIds;

trait TmdbExternalIds
{
    protected ?CommonTmdbExternalIds $external_ids = null;

    protected function setExternalIds(): void
    {
        $this->external_ids = $this->toModel('external_ids', CommonTmdbExternalIds::class);
    }

    public function getExternalIds(): ?CommonTmdbExternalIds
    {
        return $this->external_ids;
    }
}
