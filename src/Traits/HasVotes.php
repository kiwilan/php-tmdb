<?php

namespace Kiwilan\Tmdb\Traits;

trait HasVotes
{
    protected ?float $vote_average = null;

    protected ?int $vote_count = null;

    protected function setVotes(?array $data): void
    {
        if (! $data) {
            return;
        }

        $this->vote_average = $this->toFloat($data, 'vote_average');
        $this->vote_count = $this->toInt($data, 'vote_count');
    }

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    /**
     * Get the vote percentage from vote average (rounded to 2 decimal places).
     */
    public function getVotePercentage(): ?float
    {
        return round($this->vote_average * 10, 2);
    }

    public function getVoteCount(): ?int
    {
        return $this->vote_count;
    }
}
