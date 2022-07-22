<?php

namespace App\Services;
use Illuminate\Support\Str;
class SlugService
{
    public static function createSlug(string $model, string $column, string $string): string
    {
        $slug = Str::slug($string);
        if ($model::where($column, $slug)->exists()) {
            $slug .= '-' . rand();

            return self::createSlug($model, $column, $slug);
        }

        return $slug;
    }
}
