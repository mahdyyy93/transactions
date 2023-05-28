<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class TransactionInitiate
{
    public function __construct(
        public readonly int $user_id,
        public readonly int $amount,
    ) {
    }

    public static function fromRequest(Request $request): TransactionInitiate
    {
        return new self(
            $request->user()->id,
            $request->amount,
        );
    }
}
