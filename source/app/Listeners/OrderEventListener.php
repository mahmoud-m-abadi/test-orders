<?php

namespace App\Listeners;

use App\Events\OrderCreatedEvent;
use App\Interfaces\Repositories\FoodRepositoryInterface;

class OrderEventListener
{
    private FoodRepositoryInterface $foodRepository;

    public function __construct(FoodRepositoryInterface $foodRepository)
    {
        $this->foodRepository = $foodRepository;
    }

    /**
     * @param $event
     * @return void
     */
    public function onCreated($event)
    {
        $order = $event->order;

        if($order->getStatus() == true) {
            $this->foodRepository->foodIsOrdered($order->food, $order->getCount());
        }
    }

    /**
     * @param $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            OrderCreatedEvent::class,
            '\App\Listeners\OrderEventListener\onCreated'
        );
    }
}
