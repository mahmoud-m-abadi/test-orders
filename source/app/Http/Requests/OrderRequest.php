<?php

namespace App\Http\Requests;

use App\Interfaces\Models\FoodInterface;
use App\Interfaces\Models\UserInterface;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            Order::USER_ID => [
                'bail',
                'required',
                'int',
                sprintf('exists:%s,%s', UserInterface::TABLE, UserInterface::ID)
            ],
            Order::FOOD_ID => [
                'bail',
                'required',
                'int',
                sprintf('exists:%s,%s', FoodInterface::TABLE, FoodInterface::ID)
            ],
            Order::PRICE => [
                'required',
                'numeric',
            ],
            Order::COUNT => [
                'required',
                'int',
                'min:1'
            ]
        ];
    }
}
