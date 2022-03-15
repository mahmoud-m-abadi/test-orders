<?php

namespace App\Interfaces\Models;

use App\Interfaces\Traits\HasEmailInterface;
use App\Interfaces\Traits\HasIdInterface;
use App\Interfaces\Traits\HasNameInterface;
use App\Interfaces\Traits\HasPasswordInterface;
use App\Interfaces\Traits\HasStatusInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface UserInterface extends
    HasIdInterface,
    HasEmailInterface,
    HasPasswordInterface,
    HasNameInterface
{
    const TABLE = 'users';
    const EMAIL_VERIFIED_AT = 'email_verified_at';
    const REMEMBER_TOKEN = 'remember_token';

    /**
     * @return HasMany
     */
    public function orders(): HasMany;
}
