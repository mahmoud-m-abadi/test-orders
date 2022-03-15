<?php

namespace App\Interfaces\Traits;

use App\Interfaces\Models\UserInterface;

interface HasPasswordInterface
{
    const PASSWORD = 'password';

    /**
     * @param string $password Password.
     *
     * @return UserInterface
     */
    public function updatePassword(string $password): UserInterface;
}
