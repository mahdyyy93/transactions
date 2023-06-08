<?php

namespace App\Services\Wallets;

use App\Models\User;
use App\Models\Wallet;
use App\Enums\StatusEnum;

class WalletService
{
    public static function create($user_id)
    {
        $wallet = new Wallet();
        $wallet->user_id = $user_id;
        $wallet->balance = 5000;
        $wallet->save();

        return $wallet;
    }

    public function getCredit($user_id): int
    {   
        $user = User::find($user_id);

        if (!$user) abort(404, 'User not found');

        return $user->wallet->balance - $user->transactions()
            ->whereIn('status_id', [StatusEnum::COMMIT])
            ->sum('amount');
    }
}
