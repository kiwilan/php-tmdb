<?php

namespace Kiwilan\Tmdb\Models;

use Closure;
use DateTime;
use Kiwilan\Tmdb\Models\Translations\TmdbTranslation;

abstract class TmdbModel
{
    protected ?array $raw_data = null;

    public function __construct(?array $raw_data)
    {
        $this->raw_data = $raw_data;
    }

    /**
     * Get the raw data
     */
    public function getRawData(): ?array
    {
        return $this->raw_data;
    }

    /**
     * Get the raw data key
     */
    public function getRawDataKey(string $key): mixed
    {
        return $this->raw_data[$key] ?? null;
    }

    public function __set(string $name, mixed $value): void
    {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }
    }

    protected function validateData(string $key, Closure $closure): mixed
    {
        if (! $this->raw_data) {
            return null;
        }

        $values = $this->raw_data[$key] ?? null;
        if (isset($values)) {
            return $closure($values);
        }

        return null;
    }

    protected function loopOn(mixed $values, string $class, bool $nullAsDefault = true): ?array
    {
        if (! $values) {
            if ($nullAsDefault) {
                return null;
            } else {
                return [];
            }
        }

        $items = [];
        foreach ($values as $value) {
            $items[] = new $class($value);
        }

        return $items;
    }

    protected function toDateTime(string $key): ?DateTime
    {
        $date = $this->raw_data[$key] ?? null;

        return $date ? new DateTime($date) : null;
    }

    protected function toBool(string $key, bool $default = false): bool
    {
        $value = $this->raw_data[$key] ?? null;

        return $value ? boolval($value) : $default;
    }

    protected function toInt(?string $key, ?int $default = null): ?int
    {
        $value = $this->raw_data[$key] ?? null;

        return $value ? intval($value) : $default;
    }

    protected function toFloat(string $key): ?float
    {
        $value = $this->raw_data[$key] ?? null;

        return $value ? floatval($value) : null;
    }

    protected function toString(string $key): ?string
    {
        $value = $this->raw_data[$key] ?? null;

        return $value ? strval($value) : null;
    }

    protected function toArray(string $key): ?array
    {
        $value = $this->raw_data[$key] ?? null;

        return $value ? (array) $value : null;
    }

    protected function toClassArray(string $key, string $class): ?array
    {
        $data = $this->toArray($key);
        if (! $data) {
            return null;
        }

        $items = [];
        foreach ($data as $item) {
            $items[] = new $class($item);
        }

        return $items;
    }

    protected function toModel(string $key, string $class): ?object
    {
        $value = $this->raw_data[$key] ?? null;

        return $value ? new $class($value) : null;
    }

    /**
     * Parse the translations.
     *
     * @return array<string, TmdbTranslation>
     */
    protected function parseTranslations(): array
    {
        /** @var TmdbTranslation[]|null */
        $items = $this->validateData('translations', fn (array $values) => $this->loopOn($values['translations'] ?? null, TmdbTranslation::class));

        if (! $items) {
            return [];
        }

        $translations = [];
        foreach ($items as $item) {
            $translations[$item->getIso3166()] = $item;
        }

        return $translations;
    }
}
