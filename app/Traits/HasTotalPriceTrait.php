<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasTotalPriceTrait
{
    /**
     * @param Builder $builder    Builder.
     * @param integer $totalPrice TotalPrice.
     *
     * @return Builder
     */
    public function scopeWhereTotalPriceGreaterThan(Builder $builder, int $totalPrice): Builder
    {
        return $builder->where(self::TOTAL_PRICE, '>=', $totalPrice);
    }

    /**
     * @param Builder $builder    Builder.
     * @param integer $totalPrice TotalPrice.
     *
     * @return Builder
     */
    public function scopeWhereTotalPriceLessThan(Builder $builder, int $totalPrice): Builder
    {
        return $builder->where(self::TOTAL_PRICE, '<=', $totalPrice);
    }
}
