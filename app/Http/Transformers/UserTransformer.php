<?php

namespace App\Http\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;
use App\Helpers\Hasher;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'lastName' => $user->lastName,
            'username' => $user->username,
        ];
    }
}