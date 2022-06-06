<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidIdentifiable
{
    protected static function bootUuidIdentifiable()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
