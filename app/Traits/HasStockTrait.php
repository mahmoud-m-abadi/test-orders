<?php

namespace App\Traits;

use App\Interfaces\Traits\HasStockInterface;
use Illuminate\Database\Query\Builder;

trait HasStockTrait
{
    /**
     * @param int $count
     * @return HasStockInterface
     */
    public function decreaseStock(int $count): HasStockInterface
    {
        $this->decrement(self::STOCK, $count);

        return $this;
    }

    /**
     * @param int $count
     * @return HasStockInterface
     */
    public function increaseStock(int $count): HasStockInterface
    {
        $this->increment(self::STOCK, $count);

        return $this;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeWhereHasStock(Builder $builder): Builder
    {
        return $builder->where(self::STOCK, '>', 0);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeWhereHasZeroStock(Builder $builder): Builder
    {
        return $builder->where(self::STOCK, '<=', 0);
    }
}
