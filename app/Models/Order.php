<?php

namespace App\Models;

use App\Base\BaseModel;
use App\Interfaces\Models\FoodInterface;
use App\Interfaces\Models\OrderInterface;
use App\Interfaces\Models\UserInterface;
use App\Traits\HasCountTrait;
use App\Traits\HasFoodIdTrait;
use App\Traits\HasPriceTrait;
use App\Traits\HasStatusTrait;
use App\Traits\HasTotalPriceTrait;
use App\Traits\HasUserIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends BaseModel implements OrderInterface
{
    use HasFactory;
    use HasUserIdTrait;
    use HasFoodIdTrait;
    use HasPriceTrait;
    use HasTotalPriceTrait;
    use HasCountTrait;
    use HasStatusTrait;

    /**
     * @param UserInterface $user
     * @param FoodInterface $food
     * @param float|int $price
     * @param int $count
     * @param float|int $totalPrice
     * @param bool $status
     *
     * @return OrderInterface
     */
    public static function createObject(
        UserInterface $user,
        FoodInterface $food,
        float|int $price,
        int $count,
        float|int $totalPrice,
        bool $status = true
    ): OrderInterface
    {
        $item = new self;
        $item->setUserId($user->getId());
        $item->setFoodId($food->getId());
        $item->setPrice($price);
        $item->setCount($count);
        $item->setTotalPrice($totalPrice);
        $item->setStatus($status);
        $item->save();

        return $item;
    }
}
