<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{

    public function retrieved(User $user)
    {
        foreach($user->type->toArray() as $key => $value){
            $user->setAttribute($key, $value);
        }
    }
}
