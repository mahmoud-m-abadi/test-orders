<?php

namespace App\Traits;

use Illuminate\Database\Query\Builder;

trait HasExpiresAtTrait
{
    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeWhereIsNotExpired(Builder $builder): Builder
    {
        return $builder->whereDate(
            self::EXPIRES_AT,
            '>=',
            now()->format('Y-m-d')
        );
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeWhereIsExpired(Builder $builder): Builder
    {
        return $builder->whereDate(
            self::EXPIRES_AT,
            '<',
            now()->format('Y-m-d')
        );
    }
}
