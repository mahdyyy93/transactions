<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Notifications\TransactionInitiated;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TransactionStatusChanged;

class TransactionObserver
{
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
            Notification::send($transaction->user, new TransactionStatusChanged($transaction->code));    
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
