<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasIdInterface
{
    const ID = 'id';

    /**
     * @param Builder $builder Builder.
     * @param array   $ids     IDs.
     *
     * @return Builder
     */
    public function scopeWhereIdIn(Builder $builder, array $ids): Builder;

    /**
     * @param Builder $builder Builder.
     * @param array   $ids     IDs.
     *
     * @return Builder
     */
    public function scopeWhereIdNotIn(Builder $builder, array $ids): Builder;

    /**
     * @param Builder      $builder Builder.
     * @param integer|null $id      IDs.
     *
     * @return Builder
     */
    public function scopeWhereIdIsNot(Builder $builder, ?int $id = null): Builder;
}
