<?php

namespace Tests\Feature;

use App\Interfaces\Models\FoodInterface;
use App\Interfaces\Models\IngredientInterface;
use App\Interfaces\Models\UserInterface;
use App\Interfaces\Repositories\FoodRepositoryInterface;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_order_food_and_decrease_ingredient_stock()
    {
        $foodRepo = $this->app->make(FoodRepositoryInterface::class);
        $food = $foodRepo->find(1);

        $this->postJson(route('order'), [
            Order::USER_ID => User::factory()->create()->getId(),
            Order::FOOD_ID => $food->getId(),
            Order::PRICE => 1000,
            Order::COUNT => 1
        ])
            ->assertNoContent();

        $this->assertDatabaseHas(IngredientInterface::TABLE, [
            IngredientInterface::STOCK => 2
        ]);
    }
}
