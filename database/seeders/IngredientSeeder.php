<?php

namespace Database\Seeders;

use App\Interfaces\Models\IngredientInterface;
use App\Interfaces\Repositories\IngredientRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class IngredientSeeder extends Seeder
{
    private IngredientRepositoryInterface $repository;

    public function __construct(IngredientRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredientsJson = File::get(storage_path('/ingredients.json'));
        $ingredients = json_decode($ingredientsJson, true);

        foreach ($ingredients['ingredients'] as $ingredient) {
            $this->repository->store([
                IngredientInterface::TITLE => $ingredient['title'],
                IngredientInterface::BEST_BEFORE => $ingredient['best-before'],
                IngredientInterface::EXPIRES_AT => $ingredient['expires-at'],
                IngredientInterface::STOCK => $ingredient['stock'],
            ]);
        }
    }
}
