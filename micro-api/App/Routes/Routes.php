<?php

namespace App\Routes;

use App\Controllers\ApiController;

class Routes
{

    public static function RoutesList(): array
    {
        return [
            "/teste/{id}" => [ApiController::class, 'index'],
            '/' => [ApiController::class, 'index'],
            '/{id}' => [ApiController::class, 'getById']
        ];
    }
    
}
