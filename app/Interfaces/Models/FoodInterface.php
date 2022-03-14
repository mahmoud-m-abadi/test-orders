<?php

namespace App\Interfaces\Models;

use App\Interfaces\Traits\HasIdInterface;
use App\Interfaces\Traits\HasTitleInterface;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;

interface FoodInterface extends
    HasIdInterface,
    HasTitleInterface
{
    const TABLE = "foods";

    /**
     * @param string $title
     * @return FoodInterface
     */
    public static function createObject(
        string $title
    ): FoodInterface;

    /**
     * @return BelongsToMany
     */
    public function ingredients(): BelongsToMany;

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeSortByBestBeforeBeEnd(Builder $builder): Builder;
}
