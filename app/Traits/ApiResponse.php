<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * @param string|null $message
     * @param string|array|object|null $data
     * @param int $statusCode
     * @param bool $statusType
     * @return JsonResponse
     */
    protected function successResponse($message = null, $data = null, int $statusCode = 200, bool $statusType = true): JsonResponse
    {
        $responseArr = [
            'status' => $statusType,
            'code' => $statusCode,
        ];

        if (! empty($message) || $message !== null) {
            $responseArr = array_merge($responseArr, [
                'message' => $message,
            ]);
        }

        if (! empty($data) || $data !== null) {
            $responseArr = array_merge($responseArr, [
                'data' => $data,
            ]);
        }

        return response()->json($responseArr, $statusCode);
    }

    /**
     * @param  string|null  $message
     * @param  int  $statusCode
     * @param  bool  $statusType
     * @return JsonResponse
     */
    protected function errorResponse($message = null, int $statusCode = 401, bool $statusType = false): JsonResponse
    {
        return response()->json([
            'status' => $statusType,
            'code' => $statusCode,
            'message' => $message,
        ], $statusCode);
    }


}
