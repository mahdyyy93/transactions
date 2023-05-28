<?php

namespace App\Http\Controllers;

use App\DTOs\TransactionInitiate;
use App\Http\Requests\TransactionCreateRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\Transactions\Get;
use App\Services\Transactions\Initiate;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        public Initiate $transactionInitiate,
        public Get $transactionGet
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return TransactionResource::collection(
            $this->transactionGet->userTransactions(
                $request->user()
            )
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
