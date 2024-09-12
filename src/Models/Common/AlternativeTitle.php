<?php

namespace Kiwilan\Tmdb\Models\Common;

use Kiwilan\Tmdb\Models\TmdbModel;

class AlternativeTitle extends TmdbModel
{
    protected ?string $iso_3166_1 = null;

    protected ?string $title = null;

    protected ?string $type = null;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->iso_3166_1 = $this->toString($data, 'iso_3166_1');
        $this->title = $this->toString($data, 'title');
        $this->type = $this->toString($data, 'type');
    }

    /**
     * Get the ISO 3166-1, like `FI`.
     */
    public function getIso31661(): ?string
    {
        return $this->iso_3166_1;
    }

    /**
     * Get the title, like `Sagan om ringen: Härskarringen`.
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Get the type, like `Swedish title`.
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    // /**
    //  * TmdbAlternativeTitles constructor.
    //  *
    //  * @param  \Tmdb\Model\Movie\AlternativeTitle[]|\Tmdb\Model\Tv\AlternativeTitle[]  $titles
    //  */
    // protected function __construct(
    //     protected ?array $titles = null = null,
    //     protected ?string $french = null = null,
    //     protected ?string $english = null = null,
    //     protected ?string $original = null = null,
    // ) {}

    // /**
    //  * Make alternative titles.
    //  */
    // public static function make(Movie|TvSeries $model): self
    // {
    //     $self = new self($model->getAlternativeTitles()->getAll());

    //     if (! $self->titles) {
    //         return $self;
    //     }

    //     $self->french = $self->parse('FR');
    //     $self->english = $self->parse('US');
    //     $self->original = $model instanceof Movie ? $model->getOriginalTitle() : $model->getName();

    //     return $self;
    // }

    // public function getFrench(): ?string
    // {
    //     return $this->french;
    // }

    // public function getEnglish(): ?string
    // {
    //     return $this->english;
    // }

    // public function getOriginal(): ?string
    // {
    //     return $this->original;
    // }

    // private function parse(string $iso): ?string
    // {
    //     $titles = array_filter($this->titles,
    //         fn (\Tmdb\Model\Movie\AlternativeTitle|\Tmdb\Model\Tv\AlternativeTitle $title) => $title->getIso31661() === $iso);

    //     /** @var \Tmdb\Model\Movie\AlternativeTitle|\Tmdb\Model\Tv\AlternativeTitle|null */
    //     $title = $titles[array_key_first($titles)];

    //     if (! $title) {
    //         return null;
    //     }

    //     return $title->getTitle();
    // }
}
