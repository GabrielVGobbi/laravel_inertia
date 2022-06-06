<?php

namespace App\Traits;

use App\Observers\SlugObserver;

trait SlugTrait
{
    protected static function boot()
    {
        parent::boot();

        static::observe(new SlugObserver);
    }
}
