<?php

namespace App\Traits;

use App\Interfaces\Traits\HasStatusInterface;
use Illuminate\Database\Eloquent\Builder;

trait HasStatusTrait
{
    /**
     * @param Builder $builder  Builder.
     * @param array   $statuses Statuses.
     *
     * @return Builder
     */
    public function scopeWhereStatusIn(Builder $builder, array $statuses): Builder
    {
        return $builder->whereIn(self::STATUS, $statuses);
    }


    /**
     * @param Builder $builder  Builder.
     * @param array   $statuses Statuses.
     *
     * @return Builder
     */
    public function scopeWhereStatusNotIn(Builder $builder, array $statuses): Builder
    {
        return $builder->whereNotIn(self::STATUS, $statuses);
    }

    /**
     * Enable Item - set status = 1
     * @return boolean
     */
    public function setEnable(): bool
    {
        $this->setStatus(1);
        $this->save();

        return true;
    }

    /**
     * Disable Item - set status = 0
     * @return boolean
     */
    public function setDisable(): bool
    {
        $this->setStatus(0);
        $this->save();

        return true;
    }

    /**
     * @param integer|string $statusValue Status Value.
     *
     * @return mixed
     */
    public function setStatusValue(int|string $statusValue): mixed
    {
        $this->setStatus($statusValue);
        $this->save();

        return $this;
    }
}
