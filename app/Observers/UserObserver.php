<?php

namespace App\Observers;

use App\{User, Note};
USE App\Enum\NotesEnum;

class UserObserver
{
    public function created(User $user)
    {
        if($user->title != null || $user->note != null){
            Note::create([
                'entity_type' => NotesEnum::USER,
                'entity_id' => $user->id
            ]);
        }
    }
}
