<?php

namespace Database\Seeders;

use App\Interfaces\Models\FoodInterface;
use App\Interfaces\Repositories\FoodRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FoodSeeder extends Seeder
{
    private FoodRepositoryInterface $repository;

    public function __construct(FoodRepositoryInterface $repository)
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
        $foodsJson = File::get(storage_path('/foods.json'));
        $foods = json_decode($foodsJson, true);

        foreach ($foods['recipes'] as $food) {
            $this->repository->store([
                FoodInterface::TITLE => $food['title'],
                'ingredients' => $food['ingredients'],
            ]);
        }
    }
}
