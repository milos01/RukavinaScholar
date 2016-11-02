<?php

namespace App\Observers;

use App\User;

class UserObserver
{
     dd('aa');
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
         dd('aa');
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(User $user)
    {   
             dd('aa');
           
    }
}