<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\TransactionResource;
use App\Services\Transactions\Commit;

class TransactionCommitController
{
    public function __construct(public Commit $commit_service) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(int $transaction_id)
    {
        return TransactionResource::make(
            $this->commit_service->commit($transaction_id)
        );
    }
}
