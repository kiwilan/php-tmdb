<?php

namespace Kiwilan\Tmdb\Models\Common;

class AlternativeTitle
{
    protected ?string $iso_3166_1;

    protected ?string $title;

    protected ?string $type;

    public function __construct(?array $data)
    {
        if (! $data) {
            return;
        }

        $this->iso_3166_1 = $data['iso_3166_1'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->type = $data['type'] ?? null;
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
    //     protected ?array $titles = null,
    //     protected ?string $french = null,
    //     protected ?string $english = null,
    //     protected ?string $original = null,
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
