<?php

namespace App\Observers;

use App\Interfaces\Repositories\FoodRepositoryInterface;
use App\Models\Order;

class OrderObserver
{
    private FoodRepositoryInterface $foodRepository;

    public function __construct(FoodRepositoryInterface $foodRepository)
    {
        $this->foodRepository = $foodRepository;
    }

    /**
     * @param Order $order
     * @return void
     */
    public function created(Order $order)
    {
        if($order->getStatus() == true) {
            $this->foodRepository->foodIsOrdered($order->food, $order->getCount());
        }
    }
}
