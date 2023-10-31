<?php

namespace App\Services;


class ResponseService
{
    /**
     * Auth response method.
     *
     * @return array
     */

    public function AuthResponse(array $data): array
    {
        return [
            "status" => $data['status'],
            "message" => $data['message'],
            "token" => $data['token'] ?? "",
            "user" => $data['user'] ?? ""
        ];
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        return [
            'status' => TRUE,
            'message' => $message,
            'task'    => $result,
        ];
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($errorMessage)
    {
        return [
            'status' => FALSE,
            'message' => $errorMessage,
        ];
    }
}
