<?php

namespace Kiwilan\Tmdb\Models;

use Closure;
use DateTime;

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

    protected function validateData(?array $data, string $key, Closure $closure): mixed
    {
        if (! $data) {
            return null;
        }

        $values = $data[$key] ?? null;
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

    protected function toDateTime(array $data, string $key): ?DateTime
    {
        $date = $data[$key] ?? null;

        return $date ? new DateTime($date) : null;
    }

    protected function toBool(array $data, string $key, bool $default = false): bool
    {
        $value = $data[$key] ?? null;

        return $value ? boolval($value) : $default;
    }

    protected function toInt(?array $data, string $key, ?int $default = null): ?int
    {
        $value = $data[$key] ?? null;

        return $value ? intval($value) : $default;
    }

    protected function toFloat(array $data, string $key): ?float
    {
        $value = $data[$key] ?? null;

        return $value ? floatval($value) : null;
    }

    protected function toString(array $data, string $key): ?string
    {
        $value = $data[$key] ?? null;

        return $value ? strval($value) : null;
    }

    protected function toArray(array $data, string $key): ?array
    {
        $value = $data[$key] ?? null;

        return $value ? (array) $value : null;
    }

    protected function toModel(array $data, string $key, string $class): ?object
    {
        $value = $data[$key] ?? null;

        return $value ? new $class($value) : null;
    }
}
