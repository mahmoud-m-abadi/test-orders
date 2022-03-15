<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const EXCEPTION_MESSAGE = 'ex-message';

    /**
     * @param array|null $content    Content.
     * @param integer    $statusCode Status Code.
     * @param array|null $heathers   Headers.
     *
     * @return JsonResponse
     */
    public function getResponse(
        ?array $content = null,
        int $statusCode = Response::HTTP_OK,
        ?array $heathers = []
    ): JsonResponse {
        if (
            isset($content[self::EXCEPTION_MESSAGE]) &&
            !in_array(env('APP_ENV'), ['local', 'development', 'testing'])
        ) {
            unset($content[self::EXCEPTION_MESSAGE]);
        }

        return response()->json(
            ['data' => $content],
            $statusCode,
            $heathers
        );
    }
}
