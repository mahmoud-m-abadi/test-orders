<?php

namespace Tests\Feature;

use App\Interfaces\Models\IngredientInterface;
use App\Interfaces\Models\OrderInterface;
use App\Interfaces\Repositories\FoodRepositoryInterface;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_order_food_and_decrease_ingredient_stock()
    {
        $this->postJson(route('order'), $this->makeOrderData())
            ->assertNoContent();

        $this->assertDatabaseHas(IngredientInterface::TABLE, [
            IngredientInterface::STOCK => 2
        ]);
    }

    /**
     * @dataProvider  makeInvalidDataForReviewComment
     */
    public function test_user_can_not_order_food_with_invalid_data($invalidData)
    {
        [$ruleName, $payload] = $invalidData();

        $this->postJson(route('order'), $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function makeInvalidDataForReviewComment()
    {
        return [
            'it fails if USER ID is empty' => [
                function () {
                    return [
                        OrderInterface::USER_ID,
                        array_merge($this->makeOrderData(), [OrderInterface::USER_ID => null])
                    ];
                }
            ],
            'it fails if USER ID is string' => [
                function () {
                    return [
                        OrderInterface::USER_ID,
                        array_merge($this->makeOrderData(), [OrderInterface::USER_ID => 'test'])
                    ];
                }
            ],
            'it fails if FOOD ID is empty' => [
                function () {
                    return [
                        OrderInterface::FOOD_ID,
                        array_merge($this->makeOrderData(), [OrderInterface::FOOD_ID => null])
                    ];
                }
            ],
            'it fails if FOOD ID is string' => [
                function () {
                    return [
                        OrderInterface::FOOD_ID,
                        array_merge($this->makeOrderData(), [OrderInterface::FOOD_ID => 'hamber'])
                    ];
                }
            ],
            'it fails if PRICE is empty' => [
                function () {
                    return [
                        OrderInterface::PRICE,
                        array_merge($this->makeOrderData(), [OrderInterface::PRICE => null])
                    ];
                }
            ],
            'it fails if PRICE is not numeric' => [
                function () {
                    return [
                        OrderInterface::PRICE,
                        array_merge($this->makeOrderData(), [OrderInterface::PRICE => 'one'])
                    ];
                }
            ],
            'it fails if COUNT is empty' => [
                function () {
                    return [
                        OrderInterface::COUNT,
                        array_merge($this->makeOrderData(), [OrderInterface::COUNT => null])
                    ];
                }
            ],
            'it fails if COUNT is less than 1' => [
                function () {
                    return [
                        OrderInterface::COUNT,
                        array_merge($this->makeOrderData(), [OrderInterface::COUNT => 0])
                    ];
                }
            ],
            'it fails if COUNT is not integer' => [
                function () {
                    return [
                        OrderInterface::COUNT,
                        array_merge($this->makeOrderData(), [OrderInterface::COUNT => 'two'])
                    ];
                }
            ],
        ];
    }

    /**
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function makeOrderData() {
        $foodRepo = app()->make(FoodRepositoryInterface::class);
        $food = $foodRepo->find(1);

        return [
            OrderInterface::USER_ID => User::factory()->create()->getId(),
            OrderInterface::FOOD_ID => $food->getId(),
            OrderInterface::PRICE => 1000,
            OrderInterface::COUNT => 1
        ];
    }
}
