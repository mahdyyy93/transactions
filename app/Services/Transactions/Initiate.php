<?php

namespace App\Services\Transactions;

use App\Models\Status;
use App\Enums\StatusEnum;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\DTOs\TransactionInitiate;

class Initiate
{
    public function create(TransactionInitiate $dto): Transaction
    {
        return Transaction::create([
            'code' => Str::random(6),
            'user_id' => $dto->user_id,
            'amount' => $dto->amount,
            'status_id' => StatusEnum::INITIATE
        ]);
    }
}
