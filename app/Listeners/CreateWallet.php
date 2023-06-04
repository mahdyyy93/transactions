<?php

namespace App\Listeners;

use App\Services\Wallets\WalletService;
use Illuminate\Auth\Events\Registered;

class CreateWallet
{
    public WalletService $wallet_service;

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {

        $this->wallet_service = new WalletService($event->user);
        $this->wallet_service->create();
    }
}
