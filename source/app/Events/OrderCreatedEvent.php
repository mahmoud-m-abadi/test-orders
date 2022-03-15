<?php

namespace App\Events;

use App\Interfaces\Models\OrderInterface;
use Illuminate\Queue\SerializesModels;

class OrderCreatedEvent
{
    use SerializesModels;

    public OrderInterface $order;

    /**
     * @param OrderInterface $order
     */
    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }
}
