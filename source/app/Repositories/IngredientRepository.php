<?php

namespace App\Repositories;

use App\Interfaces\Models\IngredientInterface;
use App\Interfaces\Repositories\IngredientRepositoryInterface;
use App\Models\Ingredient;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class IngredientRepository implements IngredientRepositoryInterface
{
    /**
     * @return LengthAwarePaginator|Collection
     */
    public function list(): LengthAwarePaginator|Collection
    {
        return Ingredient::query()
            ->paginate();
    }

    /**
     * @param array $data
     * @return IngredientInterface
     */
    public function store(array $data): IngredientInterface
    {
        return Ingredient::createObject(
            $data[IngredientInterface::TITLE],
            $data[IngredientInterface::BEST_BEFORE],
            $data[IngredientInterface::EXPIRES_AT],
            $data[IngredientInterface::STOCK],
        );
    }

    /**
     * @param IngredientInterface $ingredient
     * @param int $count
     * @return IngredientInterface
     */
    public function decreaseStock(
        IngredientInterface $ingredient,
        int $count = 1
    ): IngredientInterface
    {
        return $ingredient->decreaseStock($count);
    }

    /**
     * @param array $titles
     * @return array
     */
    public function getIdsByTitles(array $titles): array
    {
        return Ingredient::whereIn(IngredientInterface::TITLE, $titles)
            ->select(IngredientInterface::ID)
            ->pluck(IngredientInterface::ID)
            ->toArray();
    }

    /**
     * @return void
     */
    public function increaseStockForZeroStocks(): void
    {
        Ingredient::query()
            ->whereHasZeroStock()
            ->get()
            ->each(function ($ingredient) {
                $ingredient->increaseStock(4);
            });
    }
}
