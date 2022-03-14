<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Models\OrderInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    /**
     * @return LengthAwarePaginator|Collection
     */
    public function list(): LengthAwarePaginator|Collection;

    /**
     * @param array $data Data.
     *
     * @return OrderInterface
     */
    public function store(array $data): OrderInterface;
}
