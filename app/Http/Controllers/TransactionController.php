<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\DTOs\TransactionInitiate;
use App\Services\Transactions\Initiate;
use App\Services\Wallets\WalletService;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\TransactionIndexRequest;
use App\Http\Requests\TransactionCreateRequest;

class TransactionController extends Controller
{
    public function __construct(
        public Initiate $transactionInitiate,
        public WalletService $wallet_service
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
            ->paginate()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(TransactionCreateRequest $request)
    {
        return TransactionResource::make(
            $this->transactionInitiate->create(
                TransactionInitiate::fromRequest($request)
            )
        );
    }
}
