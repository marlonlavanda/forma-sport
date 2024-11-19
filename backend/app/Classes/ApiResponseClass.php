<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ApiResponseClass
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function rollback($error, $message = "Something went wrong! Process not completed")
    {
        DB::rollBack();
        self::throw($error, $message);
    }

    public static function throw($error, $message = "Something went wrong! Process not completed")
    {
        Log::info($error);
        throw new HttpResponseException(response()->json(["message" => $message], 500));
    }

    public static function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        return response()->json([
            'data' => $result,
            'message' => $message
        ], $code);
    }
}
