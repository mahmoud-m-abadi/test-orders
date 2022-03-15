<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Models\UserInterface;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return UserInterface
     */
    public function find(int $id): UserInterface;
}
