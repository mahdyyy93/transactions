<?php

namespace App\Http\Controllers\Admin;

use App\Services\Transactions\Update;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\TransactionUpdateRequest;

class TransactionController
{
    public function __construct(
        public Update $update_service
    ) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionUpdateRequest $request)
    {
        return response()->json(
            [
                'data' => TransactionResource::make(
                    $this->update_service->update(
                        $request->request->get('transaction_id'),
                        $request->request->get('status_id')
                    )
                )
            ], 201);
    }
}
