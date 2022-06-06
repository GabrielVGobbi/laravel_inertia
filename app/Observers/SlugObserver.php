<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class SlugObserver
{
    /**
     * Handle the plan "creating" event.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function creating(Model $model)
    {
        $model->slug = Str::slug(mb_strtolower($model->name, 'UTF-8'), '_');
    }

    /**
     * Handle the plan "updating" event.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function updating(Model $model)
    {
        $model->slug = Str::slug(mb_strtolower($model->name, 'UTF-8'), '_');
    }
}
