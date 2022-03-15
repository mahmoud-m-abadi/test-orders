<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasFoodIdInterface
{
    const FOOD_ID = 'food_id';

    /**
     * @param Builder $builder Builder.
     * @param integer $foodId  ID.
     *
     * @return Builder
     */
    public function scopeOrWhereFoodIdIs(Builder $builder, int $foodId): Builder;

    /**
     * @param Builder $builder Builder.
     * @param array   $foodIds Food IDs.
     *
     * @return Builder
     */
    public function scopeWhereFoodIdIn(Builder $builder, array $foodIds): Builder;

    /**
     * @return BelongsTo
     */
    public function food(): BelongsTo;
}
