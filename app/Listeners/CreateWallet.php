<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class CreateWallet
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $event->user->wallet()->create([
            'credit' => 5000,
        ]);
    }
}
