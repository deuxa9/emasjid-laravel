<?php

namespace App\Traits;

use Str;

trait GenerateSlug
{
    public static function bootGenerateSlug()
    {
        static::creating(function ($model) {
            $model->slug = Str::slug(auth()->user()->masjid_id . '-' . $model->judul);
        });
    }
}


?>