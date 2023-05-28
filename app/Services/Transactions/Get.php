<?php

namespace App\Services\Transactions;

use App\Models\User;

class Get
{
    public function userTransactions(User $user)
    {
        return $user->transactions()->get();
    }
}
