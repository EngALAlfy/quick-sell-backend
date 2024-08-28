<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use UAParser\Exception\FileNotFoundException;
use UAParser\Parser;

trait JsonFuncsTrait {

    /**
     * Get a success response
     *
     * @param null $data
     * @param string|null $message
     * @param array $meta
     *
     * @return JsonResponse
     */
    protected function sendJsonSuccess($data = null , string $message = null, array $meta = []): JsonResponse
    {
        if($message === null){
            $message =  __("Done successfully");
        }
        return response()->json(
            [
                'success' => true,
                'data' => $data ?? [],
                'message' => $message,
            ], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get an error response
     *
     * @param $error
     * @param int $code
     *
     * @return JsonResponse
     */
    protected function sendJsonError($error, int $code = 422): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $error,
        ], $code, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

}
