<?php

namespace App\Services\Wallets;

use App\Models\User;
use App\Models\Wallet;
use App\Enums\StatusEnum;

class WalletService
{
    public static function create($user_id): Wallet
    {
        $user = User::find($user_id);

        if (!$user) abort(404, 'User not found');

        return $user->wallet()->create([
            'balance' => 5000,
        ]);
    }
}
