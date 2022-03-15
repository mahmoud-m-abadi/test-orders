<?php

namespace App\Models;

use App\Base\BaseModel;
use App\Interfaces\Models\FoodInterface;
use App\Traits\HasTitleTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Food extends BaseModel implements FoodInterface
{
    use HasFactory;
    use SoftDeletes;
    use HasTitleTrait;

    protected $dates = [self::DELETED_AT];
    protected $table = self::TABLE;

    /**
     * @param string $title
     * @return FoodInterface
     */
    public static function createObject(
        string $title
    ): FoodInterface
    {
        $item = new self();
        $item->setTitle($title);
        $item->save();

        return $item;
    }

    /**
     * @return BelongsToMany
     */
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'food_ingredients');
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeSortByBestBeforeBeEnd(Builder $builder): Builder
    {
        $nowDate = now()->format("Y-m-d");
        return $builder->orderByRaw(
            "CASE WHEN (SELECT count(food_ingredients.food_id)
                 from ingredients
                     join food_ingredients on ingredients.id = food_ingredients.ingredient_id
                 where foods.id = food_ingredients.food_id
                   and DATE(ingredients.expires_at) >= Date('$nowDate')
                   and DATE(ingredients.best_before) <= Date('$nowDate')
                ) THEN 1 ELSE 0 END"
        );
    }
}
