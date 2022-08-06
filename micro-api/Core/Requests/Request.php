<?php

namespace Core\Requests;

class Request
{

    public function Get(): array
    {
        return $_GET;
    }

    public function Post(): array
    {
        return $_POST;
    }

    public function Server(): array
    {
        return $_SERVER;
    }

    public function Input(string $input = "")
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $methods = [
            'POST' => function () use ($input) {
                if($input){
                    return $_POST[$input]; 
                }
                
                return $_POST;
            },
            'GET' => function () use ($input) {
                if($input){
                    return $_GET[$input]; 
                }

                return $_GET;
            },
        ];

        return $methods[$method]();
    }

    public function RoutePath(): string
    {
        return explode('?', $_SERVER['REQUEST_URI'])[0] ?? $_SERVER['REQUEST_URI'];
    }
}
