<?php

namespace Kiwilan\Tmdb\Results\Common;

use DateTime;
use Kiwilan\Tmdb\Models\TmdbModel;

class ResultsDates extends TmdbModel
{
    protected ?DateTime $maximum = null;

    protected ?DateTime $minimum = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->maximum = $this->toDateTime($data, 'maximum');
        $this->minimum = $this->toDateTime($data, 'minimum');
    }

    public function getMaximum(): ?DateTime
    {
        return $this->maximum;
    }

    public function getMinimum(): ?DateTime
    {
        return $this->minimum;
    }
}
