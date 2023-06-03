<?php

namespace App\Services\Transactions;

use App\Models\Status;
use App\Enums\StatusEnum;
use App\Models\Transaction;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Update
{
    public function update(int $t_id, int $status_id): Transaction
    {
        $transaction = Transaction::find($t_id);

        if ($transaction) {
            $transaction->status_id = $status_id;
            $transaction->save();

            return $transaction;
        }

        throw new NotFoundHttpException;
    }
}
