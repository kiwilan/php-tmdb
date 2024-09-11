<?php

namespace Kiwilan\Tmdb\Models;

class AlternativeTitles
{
    /**
     * TmdbAlternativeTitles constructor.
     *
     * @param  \Tmdb\Model\Movie\AlternativeTitle[]|\Tmdb\Model\Tv\AlternativeTitle[]  $titles
     */
    protected function __construct(
        protected ?array $titles = null,
        protected ?string $french = null,
        protected ?string $english = null,
        protected ?string $original = null,
    ) {}

    /**
     * Make alternative titles.
     */
    public static function make(\Tmdb\Model\Movie|\Tmdb\Model\Tv $model): self
    {
        $self = new self($model->getAlternativeTitles()->getAll());

        if (! $self->titles) {
            return $self;
        }

        $self->french = $self->parse('FR');
        $self->english = $self->parse('US');
        $self->original = $model instanceof \Tmdb\Model\Movie ? $model->getOriginalTitle() : $model->getName();

        return $self;
    }

    public function getFrench(): ?string
    {
        return $this->french;
    }

    public function getEnglish(): ?string
    {
        return $this->english;
    }

    public function getOriginal(): ?string
    {
        return $this->original;
    }

    private function parse(string $iso): ?string
    {
        $titles = array_filter($this->titles,
            fn (\Tmdb\Model\Movie\AlternativeTitle|\Tmdb\Model\Tv\AlternativeTitle $title) => $title->getIso31661() === $iso);

        /** @var \Tmdb\Model\Movie\AlternativeTitle|\Tmdb\Model\Tv\AlternativeTitle|null */
        $title = $titles[array_key_first($titles)];

        if (! $title) {
            return null;
        }

        return $title->getTitle();
    }
}
