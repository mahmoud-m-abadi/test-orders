<?php

namespace Tests\Feature;

use App\Interfaces\Models\FoodInterface;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_menu_for_food_not_expired_and_has_stock()
    {
        $this->withoutExceptionHandling();

        /** There is one expired ingredient item that effects in result */
        $this->getJson(route('menu'))
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');

        // check all in db without filtering
        $this->assertDatabaseCount(FoodInterface::TABLE, 4);
    }

    public function test_user_see_foods_based_on_the_best_before_field_in_the_end_of_list_in_menu()
    {
        $foodNameShouldBeLastDueToBestBefore = 'Fry-up';

        /** There is one expired ingredient item that effects in result */
        $this->getJson(route('menu'))
            ->assertStatus(200)
            ->assertJsonPath('data.2.title', $foodNameShouldBeLastDueToBestBefore);
    }
}
