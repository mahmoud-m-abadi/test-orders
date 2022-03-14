<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MenuTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_get_menu()
    {
        $response = $this->getJson('/');

        $response->assertStatus(200);
    }

    public function test_user_can_not_see_expired_food_in_menu()
    {

    }

    public function test_user_see_foods_in_best_before_situation_in_end_of_list_in_menu()
    {

    }

    public function test_user_can_not_see_food_in_menu_with_zero_stock()
    {

    }
}
