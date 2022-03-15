<?php

namespace App\Http\Controllers;

use App\Http\Resources\FoodResource;
use App\Interfaces\Repositories\FoodRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FoodController extends Controller
{
    private FoodRepositoryInterface $foodRepository;

    public function __construct(
        FoodRepositoryInterface $foodRepository
    )
    {
        $this->foodRepository = $foodRepository;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        return FoodResource::collection(
            $this->foodRepository->list()
        );
    }
}
