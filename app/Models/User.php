<?php

namespace App\Models;

use App\Interfaces\Models\UserInterface;
use App\Traits\HasEmailTrait;
use App\Traits\HasIdTrait;
use App\Traits\HasNameTrait;
use App\Traits\HasPasswordTrait;
use App\Traits\MagicMethodsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements UserInterface
{
    use HasApiTokens, HasFactory, Notifiable;
    use MagicMethodsTrait;

    use HasIdTrait;
    use HasEmailTrait;
    use HasNameTrait;
    use HasPasswordTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::PASSWORD,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::PASSWORD,
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
