<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Interfaces\Repositories\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function __invoke(OrderRequest $request): JsonResponse
    {
        $result = $this->orderRepository->store(
            $request->validated()
        );

        if (isset($result['error'])) {
            return $this->getResponse($result, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->getResponse([], Response::HTTP_NO_CONTENT);
    }
}
