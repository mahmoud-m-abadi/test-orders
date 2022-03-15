<?php

namespace App\Repositories;

use App\Events\OrderCreatedEvent;
use App\Interfaces\Models\OrderInterface;
use App\Interfaces\Repositories\FoodRepositoryInterface;
use App\Interfaces\Repositories\OrderRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    private UserRepositoryInterface $userRepository;
    private FoodRepositoryInterface $foodRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        FoodRepositoryInterface $foodRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->foodRepository = $foodRepository;
    }

    /**
     * @return LengthAwarePaginator|Collection
     */
    public function list(): LengthAwarePaginator|Collection
    {
        return Order::query()
            ->with(['food','user'])
            ->paginate();
    }

    /**
     * @param array $data
     * @return array|OrderInterface
     */
    public function store(array $data): array|OrderInterface
    {
        DB::beginTransaction();

        try {
            $order = Order::createObject(
                $this->userRepository->find($data[Order::USER_ID]),
                $this->foodRepository->find($data[Order::FOOD_ID]),
                $data[Order::PRICE],
                $data[Order::COUNT],
                ($data[Order::PRICE] * $data[Order::COUNT]),
            );

            /** I used the Observer Event after creating an Order,
             * OR We can use Event Listener after creating like following line
             */
            // event(new OrderCreatedEvent($order));
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
        DB::commit();

        return $order;
    }
}
