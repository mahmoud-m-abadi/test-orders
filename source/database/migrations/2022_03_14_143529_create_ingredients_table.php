<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Interfaces\Models\IngredientInterface;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(IngredientInterface::TABLE, function (Blueprint $table) {
            $table->id();

            $table->string(IngredientInterface::TITLE)
                ->index();
            $table->date(IngredientInterface::BEST_BEFORE)->index();
            $table->date(IngredientInterface::EXPIRES_AT);
            $table->integer(IngredientInterface::STOCK)->default(1);

            $table->timestamps();
            $table->softDeletes();

            $table->index([
                IngredientInterface::EXPIRES_AT,
                IngredientInterface::STOCK
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(IngredientInterface::TABLE);
    }
};
