<?php

namespace App\Listeners;

use App\Services\Wallets\WalletService;
use Illuminate\Auth\Events\Registered;

class CreateWallet
{
    public function __construct(
        public WalletService $wallet_service
    ) {}

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $this->wallet_service->create($event->user->id);
    }
}
