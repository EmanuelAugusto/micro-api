<?php

namespace App\Routes;

use App\Controllers\ApiController;

class Routes
{

    public static function RoutesList(): array
    {
        return [
            '/' => [ApiController::class, 'index'],
            '/{id}' => [ApiController::class, 'getById']
        ];
    }
    
}
