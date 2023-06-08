<?php

namespace App\Services\Wallets;

use App\Models\User;
use App\Models\Wallet;
use App\Enums\StatusEnum;

class WalletService
{
    public static function create($user_id)
    {
        $user = User::find($user_id);

        if (!$user) abort(404, 'User not found');

        return $user->wallet()->create([
            'balance' => 5000,
        ]);
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
