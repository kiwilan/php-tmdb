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

        parent::__construct($data);

        $this->maximum = $this->toDateTime('maximum');
        $this->minimum = $this->toDateTime('minimum');
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
