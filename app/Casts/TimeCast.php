<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class TimeCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value) : null;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value instanceof Carbon
            ? $value->format('H:i:s')
            : $value;
    }
}