<?php

namespace App\Traits;

use App\Models\Food;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasFoodIdTrait
{
    /**
     * @param Builder $builder Builder.
     * @param integer $foodId  Food ID.
     *
     * @return Builder
     */
    public function scopeOrWhereFoodIdIs(Builder $builder, int $foodId): Builder
    {
        return $builder->orWhere(self::FOOD_ID, $foodId);
    }

    /**
     * @param Builder $builder Builder.
     * @param array   $foodIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereFoodIdIn(Builder $builder, array $foodIds): Builder
    {
        return $builder->whereIn(self::FOOD_ID, $foodIds);
    }

    /**
     * @return BelongsTo
     */
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
