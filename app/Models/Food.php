<?php

namespace App\Models;

use App\Base\BaseModel;
use App\Interfaces\Models\FoodInterface;
use App\Traits\HasTitleTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

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
        // TODO: Make a sub query to select ids for putting in sort by
        return $builder;
    }
}
