<?php

namespace App\Observers;

use App\{Transaction, Note};
USE App\Enum\NotesEnum;

class TransactionObserver
{
    public function created(Transaction $transaction)
    {
        if($transaction->title !=null || $transaction->note != null){
            Note::create([
                'entity_type' => NotesEnum::TRANSACTION,
                'entity_id' => $transaction->id
            ]);
        }
    }
}
