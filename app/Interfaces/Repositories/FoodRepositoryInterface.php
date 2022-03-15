<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Models\FoodInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface FoodRepositoryInterface
{
    /**
     * @return LengthAwarePaginator|Collection
     */
    public function list(): LengthAwarePaginator|Collection;

    /**
     * @param array $data
     * @return array|FoodInterface
     */
    public function store(array $data): array|FoodInterface;

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): FoodInterface;

    /**
     * @param FoodInterface $food
     * @param int $count
     * @return mixed
     */
    public function foodIsOrdered(FoodInterface $food, int $count = 1): FoodInterface;
}
