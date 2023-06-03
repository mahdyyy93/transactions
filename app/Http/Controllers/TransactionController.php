<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\DTOs\TransactionInitiate;
use App\Services\Transactions\Get;
use App\Services\Transactions\Initiate;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\TransactionIndexRequest;
use App\Http\Requests\TransactionCreateRequest;

class TransactionController extends Controller
{
    public function __construct(
        public Initiate $transactionInitiate
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(TransactionIndexRequest $request)
    {
        $status = $request->query('status_id');

        return TransactionResource::collection(
            Transaction::filterByUserIfNotAdmin()
            ->when($status, function($query, $status) {
                    return $query->where('status_id', $status);
                })
            ->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TransactionCreateRequest $request)
    {
        return TransactionResource::make(
            $this->transactionInitiate->create(
                TransactionInitiate::fromRequest($request)
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
