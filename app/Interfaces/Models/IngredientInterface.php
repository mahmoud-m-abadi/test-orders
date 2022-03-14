<?php

namespace App\Interfaces\Models;

use App\Interfaces\Traits\HasBestBeforeInterface;
use App\Interfaces\Traits\HasExpiresAtInterface;
use App\Interfaces\Traits\HasIdInterface;
use App\Interfaces\Traits\HasStockInterface;
use App\Interfaces\Traits\HasTitleInterface;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface IngredientInterface extends
    HasIdInterface,
    HasTitleInterface,
    HasBestBeforeInterface,
    HasExpiresAtInterface,
    HasStockInterface
{
    const TABLE = 'ingredients';

    /**
     * @param string $title
     * @param string $bestBefore
     * @param string $expiresAt
     * @param int $stock
     * @return IngredientInterface
     */
    public static function createObject(
        string $title,
        string $bestBefore,
        string $expiresAt,
        int $stock
    ): IngredientInterface;

    /**
     * @return BelongsToMany
     */
    public function foods(): BelongsToMany;
}
