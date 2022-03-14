<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasStatusInterface
{
    const STATUS = 'status';

    /**
     * @param Builder $builder
     * @param array   $statuses
     * @return Builder
     */
    public function scopeWhereStatusIn(Builder $builder, array $statuses): Builder;

    /**
     * @param Builder $builder
     * @param array   $statuses
     * @return Builder
     */
    public function scopeWhereStatusNotIn(Builder $builder, array $statuses): Builder;

    /**
     * Enable Item - set status = 1
     * @return boolean
     */
    public function setEnable(): bool;

    /**
     * Disable Item - set status = 0
     * @return boolean
     */
    public function setDisable(): bool;

    /**
     * @param integer|string $statusValue Status Value.
     *
     * @return mixed
     */
    public function setStatusValue(int|string $statusValue): mixed;
}
