<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasStockInterface
{
    const STOCK = 'stock';

    /**
     * @param int $count
     * @return HasStockInterface
     */
    public function decreaseStock(int $count): HasStockInterface;

    /**
     * @param int $count
     * @return HasStockInterface
     */
    public function increaseStock(int $count): HasStockInterface;

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeWhereHasStock(Builder $builder): Builder;

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeWhereHasZeroStock(Builder $builder): Builder;
}
