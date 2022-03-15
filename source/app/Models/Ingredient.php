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
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeHasActiveIngredients(Builder $builder): Builder
    {
        $date = now()->format("Y-m-d");
        return $builder->groupBy('food_ingredients.food_id')
            ->havingRaw("COUNT(food_ingredients.ingredient_id) = (
              select COUNT(food_ingredients.ingredient_id) from ingredients
                    join food_ingredients on ingredients.id = food_ingredients.ingredient_id
              where foods.id = food_ingredients.food_id
                and ingredients.stock > 0
                and DATE(ingredients.expires_at) >= Date('$date')
              )"
            );
    }
}
