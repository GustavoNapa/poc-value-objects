<?php

namespace App\Casts;

use App\ValueObjects\Cpf as CpfValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Cpf implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return CpfValueObject::fromString($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (!$value instanceof CpfValueObject) {
            throw new InvalidArgumentException('The given value is not an CPF instance.');
        }

        return $value->toString();
    }
}
