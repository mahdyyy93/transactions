<?php

namespace App\Http\Controllers\Admin;

use App\Services\Transactions\Commit;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\TransactionCommitRequest;

class TransactionCommitController
{
    public function __construct(public Commit $commit_service) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionCommitRequest $request)
    {
        return response()->json(['data' => TransactionResource::make(
            $this->commit_service->commit($request->request->get('transaction_id'))
        )], 201);
        
    }
}
