<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasPriceTrait
{
    /**
     * @param Builder $builder Builder.
     * @param integer $price   Price.
     *
     * @return Builder
     */
    public function scopeWherePriceGreaterThan(Builder $builder, int $price): Builder
    {
        return $builder->where(self::PRICE, '>=', $price);
    }

    /**
     * @param Builder $builder Builder.
     * @param integer $price   Price.
     *
     * @return Builder
     */
    public function scopeWherePriceLessThan(Builder $builder, int $price): Builder
    {
        return $builder->where(self::PRICE, '<=', $price);
    }

    /**
    * @param integer|float $price Price.
    * @return integer|float
    */
    public function increasePrice(int|float $price): int|float
    {
        $this->setPrice($this->getPrice() + $price);
        $this->save();

        return $this->getPrice();
    }

    /**
     * @param integer|float $price Price.
     * @return integer|float
     */
    public function decreasePrice(int|float $price): int|float
    {
        /** @var float|int $price */
        $price = $this->getPrice() >= $price ? $this->getPrice() - $price : 0;

        $this->setPrice($price);
        $this->save();

        return $this->getPrice();
    }
}
