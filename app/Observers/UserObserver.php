<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        event(new Registered($user));
    }
}
