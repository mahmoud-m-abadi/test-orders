<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Interfaces\Models\OrderInterface;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(OrderInterface::TABLE, function (Blueprint $table) {
            $table->id();

            $table->foreignId(OrderInterface::USER_ID)
                ->nullable()
                ->constrained();
            $table->foreignId(OrderInterface::FOOD_ID)
                ->constrained(\App\Interfaces\Models\FoodInterface::TABLE)
                ->cascadeOnDelete();

            $table->double(OrderInterface::PRICE)
                ->default(0);
            $table->mediumInteger(OrderInterface::COUNT)
                ->default(1);
            $table->double(OrderInterface::TOTAL_PRICE)
                ->default(0);
            $table->boolean(OrderInterface::STATUS)
                ->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(OrderInterface::TABLE);
    }
};
