<?php

namespace App\Repositories;

use App\Interfaces\Models\UserInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param int $id
     * @return UserInterface
     */
    public function find(int $id): UserInterface
    {
        return User::whereId($id)->first();
    }
}
