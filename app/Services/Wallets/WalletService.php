<?php

namespace App\Services\Wallets;

use App\Models\User;
use App\Models\Wallet;
class WalletService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create()
    {
        $wallet = new Wallet();
        $wallet->user_id = $this->user->id;
        $wallet->balance = 5000;
        $wallet->save();
        
        return $wallet;
    }

    public function getCredit()
    {
        // Create a new wallet for the user.
        $wallet = Wallet::create([
            'user_id' => $this->user->id,
            'balance' => 5000,
        ]);

        // Attach the wallet to the user.
        $this->user->wallets()->attach($wallet->id);

        return $wallet;
    }
}
