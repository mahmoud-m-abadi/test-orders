<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Models\IngredientInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IngredientRepositoryInterface
{
    /**
     * @return LengthAwarePaginator|Collection
     */
    public function list(): LengthAwarePaginator|Collection;

    /**
     * @param array $data Data.
     * @return IngredientInterface
     */
    public function store(array $data): IngredientInterface;

    /**
     * @param IngredientInterface $ingredient
     * @param int $count
     * @return IngredientInterface
     */
    public function decreaseStock(
        IngredientInterface $ingredient,
        int $count = 1
    ): IngredientInterface;

    /**
     * @param array $titles
     * @return array
     */
    public function getIdsByTitles(array $titles): array;

    /**
     * @return void
     */
    public function increaseStockForZeroStocks(): void;
}
