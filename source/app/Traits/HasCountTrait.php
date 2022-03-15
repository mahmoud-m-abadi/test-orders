<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasCountTrait
{
    /**
     * @param Builder $builder Builder.
     * @param float   $count   Count.
     *
     * @return Builder
     */
    public function scopeWhereCountGreaterThan(Builder $builder, float $count): Builder
    {
        return $builder->where(self::COUNT, '>', $count);
    }

    /**
     * @param Builder $builder Builder.
     * @param float   $count   Count.
     *
     * @return Builder
     */
    public function scopeWhereCountLessThan(Builder $builder, float $count): Builder
    {
        return $builder->where(self::COUNT, '<', $count);
    }
    /**
     * @param Builder $builder Builder.
     * @param float   $count   Count.
     *
     * @return Builder
     */
    public function scopeWhereCountGreaterThanEqual(Builder $builder, float $count): Builder
    {
        return $builder->where(self::COUNT, '>=', $count);
    }

    /**
     * @param Builder $builder Builder.
     * @param float   $count   Count.
     *
     * @return Builder
     */
    public function scopeWhereCountLessThanEqual(Builder $builder, float $count): Builder
    {
        return $builder->where(self::COUNT, '<=', $count);
    }
}
