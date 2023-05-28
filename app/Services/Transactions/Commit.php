<?php

namespace App\Services\Transactions;

use App\Models\Transaction;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Commit
{
    public function commit(int $t_id)
    {
        $transaction = Transaction::find($t_id);

        if ($transaction) {
            $transaction->status_id = 1;
            $transaction->save();

            return $transaction;
        }

        throw new NotFoundHttpException;
    }
}
