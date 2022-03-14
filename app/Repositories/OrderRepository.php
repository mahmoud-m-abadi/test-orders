<?php

namespace App\Repositories;

use App\Interfaces\Models\OrderInterface;
use App\Interfaces\Repositories\OrderRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function list(): LengthAwarePaginator|Collection
    {
        // TODO: Implement list() method.
    }

    public function store(array $data): OrderInterface
    {
        // TODO: Implement store() method.
    }
}
