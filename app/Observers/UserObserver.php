<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the plan "creating" event.
     *
     * @param \Illuminate\Database\Eloquent\User $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->name = titleCase($user->name);
        $user->password = Hash::make($user->password);
        $user->uuid = Str::uuid();
    }

    public function updating(User $user)
    {
        $user->name = titleCase($user->name);
    }
}
