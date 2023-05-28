<?php

namespace App\Services\Transactions;

use App\DTOs\TransactionInitiate;
use App\Models\Transaction;
use Illuminate\Support\Str;

class Initiate
{
    public function create(TransactionInitiate $dto)
    {
        return Transaction::create([
            'code' => Str::random(6),
            'user_id' => $dto->user_id,
            'amount' => $dto->amount,
            'status_id' => 1,
        ]);
    }
}
