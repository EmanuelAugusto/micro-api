<?php

namespace App\Routes;

use App\Controllers\ApiController;

class Routes
{

    public static function RoutesList(): array
    {
        return [
            ["/teste", 'GET', ApiController::class, 'index'],
            ["/teste/{id}", 'GET', ApiController::class, 'getById'],
            ["/teste/{id}", 'POST', ApiController::class, 'create'],
            ["/teste/{id}", 'PUT', ApiController::class, 'updateById'],
            ["/teste/{id}", 'DELETE', ApiController::class, 'deleteById']
        ];
    }
}
