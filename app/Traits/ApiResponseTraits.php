<?php

namespace App\Traits;

trait ApiResponseTraits
{
    public function sendResponse($result, $message) {
        return response()->json([
            "success" => true,
            "data" => $result,
            "message"=> $message,
        ], 200);
    }

    public function sendError($errorData, $message, $code = 404) {
        return response()->json([
            "success" => true,
            "data" => $errorData,
            "message"=> $message,
        ], $code);
    }
}
