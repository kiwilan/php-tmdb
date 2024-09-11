<?php

namespace Kiwilan\Tmdb\Models\Results;

class SearchMovieResult
{
    public ?bool $adult = null;

    public ?string $backdrop_path = null;

    /** @var int[] */
    public ?array $genre_ids = null;

    public ?int $id = null;

    public ?string $original_language = null;

    public ?string $original_title = null;

    public ?string $overview = null;

    public ?float $popularity = null;

    public ?string $poster_path = null;

    public ?string $release_date = null;

    public ?string $title = null;

    public ?bool $video = null;

    public ?float $vote_average = null;

    public ?int $vote_count = null;

    public ?string $media_type = null;

    public function __construct(array $data)
    {
        $this->adult = $data['adult'] ?? null;
        $this->backdrop_path = $data['backdrop_path'] ?? null;
        $this->genre_ids = $data['genre_ids'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->original_language = $data['original_language'] ?? null;
        $this->original_title = $data['original_title'] ?? null;
        $this->overview = $data['overview'] ?? null;
        $this->popularity = $data['popularity'] ?? null;
        $this->poster_path = $data['poster_path'] ?? null;
        $this->release_date = $data['release_date'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->video = $data['video'] ?? null;
        $this->vote_average = $data['vote_average'] ?? null;
        $this->vote_count = $data['vote_count'] ?? null;
        $this->media_type = $data['media_type'] ?? null;
    }
}
