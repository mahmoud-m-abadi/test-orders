<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasExpiresAtInterface
{
    const EXPIRES_AT = 'expires_at';

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeWhereIsNotExpired(Builder $builder): Builder;

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeWhereIsExpired(Builder $builder): Builder;
}
