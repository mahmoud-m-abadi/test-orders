<?php

namespace App\Traits;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUserIdTrait
{
    /**
     * @param Builder $builder Builder.
     * @param integer $userId  ID.
     *
     * @return Builder
     */
    public function scopeOrWhereUserIdIs(Builder $builder, int $userId): Builder
    {
        return $builder->orWhere(self::USER_ID, $userId);
    }

    /**
     * @param Builder $builder Builder.
     * @param array   $userIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereUserIdIn(Builder $builder, array $userIds): Builder
    {
        return $builder->whereIn(self::USER_ID, $userIds);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
