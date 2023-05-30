<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Transactions\Commit;
use App\Http\Resources\TransactionResource;

class TransactionCommitController
{
    public function __construct(public Commit $commit_service) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return response()->json(['data' => TransactionResource::make(
            $this->commit_service->commit($request->request->get('transaction_id'))
        )], 201);
        
    }
}
