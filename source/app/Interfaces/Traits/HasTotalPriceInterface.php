<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasTotalPriceInterface
{
    const TOTAL_PRICE = 'total_price';

    /**
     * @param Builder $builder    Builder.
     * @param integer $totalPrice TotalPrice.
     *
     * @return Builder
     */
    public function scopeWhereTotalPriceGreaterThan(Builder $builder, int $totalPrice): Builder;

    /**
     * @param Builder $builder    Builder.
     * @param integer $totalPrice TotalPrice.
     *
     * @return Builder
     */
    public function scopeWhereTotalPriceLessThan(Builder $builder, int $totalPrice): Builder;
}
