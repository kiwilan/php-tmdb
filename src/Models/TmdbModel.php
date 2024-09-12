<?php

namespace Kiwilan\Tmdb\Models;

use Closure;
use DateTime;

class TmdbModel
{
    protected function validateData(array $data, string $key, Closure $closure): mixed
    {
        $values = $data[$key] ?? null;
        if (isset($values) && is_array($values)) {
            return $closure($values);
        }

        return null;
    }

    protected function loopOn(mixed $values, string $class): array
    {
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

    protected function toBool(array $data, string $key): bool
    {
        $value = $data[$key] ?? null;

        return $value ? boolval($value) : false;
    }

    protected function toInt(array $data, string $key, ?int $default = null): ?int
    {
        $value = $data[$key] ?? null;
        if ($default) {
            return $value ? intval($value) : $default;
        }

        return $value ? intval($value) : null;
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
