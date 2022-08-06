<?php

namespace Core\Responses;

trait Responses
{
    function Headers($header)
    {
        header($header);
    }

    function statusCode(int $statusCode)
    {
        http_response_code($statusCode);
    }

    function Redirect(string $url)
    {
        header("Location: $url");
        die();
    }

    function sendJson($data = [], $statusCode = 200, $headers = [])
    {
        $this->Headers('Content-Type: application/json');

        foreach ($headers as $value) {
            $this->Headers($value);
        }

        $this->statusCode($statusCode);

        return json_encode($data);
    }
}
