<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Notifications\TransactionInitiated;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TransactionStatusChanged;

class TransactionObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the Transaction "creating" event.
     */
    public function creating(Transaction $transaction): void
    {
        if ($transaction->amount > $transaction->user->wallet->credit)
        {
            abort(403, 'Not enough credit');
        }
    }

    /**
     * Handle the Transaction "updating" event.
     */
    public function updating(Transaction $transaction): void
    {
        if ($transaction->amount - $transaction->getRawOriginal('amount') > $transaction->user->wallet->credit) {
            abort(403, 'Not enough credit');
        }
    }

    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        Notification::send($transaction->user, new TransactionInitiated($transaction)); 
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        if ($transaction->isDirty('status_id')) {
            Notification::send($transaction->user, new TransactionStatusChanged($transaction));    
        }
    }
}
