<?php

namespace App\Core;

class Response
{
    public function HTTPResponse($code, $message, $data)
    {
        header('Content-Type: application/http');
        http_response_code($code);
        echo json_encode([
            'status' => $this->defineStatus($code),
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function defineStatus($statusCode)
    {
        switch($statusCode) {
            case 200: $statusMessage = 'OK'; break;
            case 201: $statusMessage = 'Created'; break;
            case 400: $statusMessage = 'Bad Request'; break;
            case 404: $statusMessage = 'Not Found'; break;
            case 500: $statusMessage = 'Internal Server Error'; break;
            default: $statusMessage = 'Unknown Status';
        }

        return $statusMessage;
    }
}