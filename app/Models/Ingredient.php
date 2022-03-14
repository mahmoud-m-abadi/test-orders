<?php

namespace App\Models;

use App\Base\BaseModel;
use App\Interfaces\Models\IngredientInterface;
use App\Traits\HasBestBeforeTrait;
use App\Traits\HasExpiresAtTrait;
use App\Traits\HasStockTrait;
use App\Traits\HasTitleTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends BaseModel implements IngredientInterface
{
    use HasFactory;
    use SoftDeletes;

    use HasTitleTrait;
    use HasBestBeforeTrait;
    use HasExpiresAtTrait;
    use HasStockTrait;

    protected $dates = [self::DELETED_AT];

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
    ): IngredientInterface
    {
        $item = new self();
        $item->setTitle($title);
        $item->setBestBefore($bestBefore);
        $item->setExpiresAt($expiresAt);
        $item->setStock($stock);
        $item->save();

        return $item;
    }

    /**
     * @return BelongsToMany
     */
    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'food_ingredients');
    }
}
