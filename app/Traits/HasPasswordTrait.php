<?php

namespace App\Traits;

use App\Interfaces\Models\UserInterface;
use Illuminate\Support\Facades\Hash;

trait HasPasswordTrait
{
    /**
     * @param string $password
     * @return boolean
     */
    public function updatePassword(string $password): UserInterface
    {
        $this->setPassword(Hash::make($password));
        $this->save();

        return $this;
    }
}
