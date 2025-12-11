<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull as BaseMiddleware;

class SafeConvertEmptyStringsToNull extends BaseMiddleware
{
    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        // THE CRASH GUARD:
        // This prevents a crash if a malformed request sends a non-string/non-array 
        // value that isn't null, which the original class doesn't explicitly check for.
        if (! is_array($value) && ! is_string($value) && ! is_null($value)) {
            return $value; 
        }

        // Original Laravel logic continues here:
        return $value === '' ? null : $value;
    }
}