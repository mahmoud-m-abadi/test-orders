<?php

namespace App\Repositories;

use App\Interfaces\Models\FoodInterface;
use App\Interfaces\Repositories\FoodRepositoryInterface;
use App\Interfaces\Repositories\IngredientRepositoryInterface;
use App\Models\Food;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FoodRepository implements FoodRepositoryInterface
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * @return LengthAwarePaginator|Collection
     */
    public function list(): LengthAwarePaginator|Collection
    {
        return Food::query()
            ->with('ingredients')
            ->whereHas(
                'ingredients',
                fn($ingredients) => $ingredients->hasActiveIngredients()
            )
            ->sortByBestBeforeBeEnd()
            ->paginate();
    }

    /**
     * @param array $data
     * @return array|FoodInterface
     */
    public function store(array $data): array|FoodInterface
    {
        DB::beginTransaction();

        try {
            $food = Food::createObject(
                $data[FoodInterface::TITLE]
            );

            /** Sync ingredients */
            $food->ingredients()->sync(
                $this->ingredientRepository->getIdsByTitles($data['ingredients'])
            );
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
        DB::commit();

        return $food;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): FoodInterface
    {
        return Food::whereId($id)->first();
    }

    /**
     * @param FoodInterface $food
     * @param int $count
     * @return FoodInterface
     */
    public function foodIsOrdered(
        FoodInterface $food,
        int $count = 1
    ): FoodInterface
    {
        $ingredients = $food->ingredients;
        foreach ($ingredients as $ingredient) {
            $this->ingredientRepository->decreaseStock($ingredient, $count);
        }

        return $food;
    }
}
