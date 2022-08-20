<?php

use App\Controllers\ApiController;
use App\Middlewares\ExampleMiddleware;
use Core\Routes\Routes;

Routes::get(["/teste", 'GET', ApiController::class, 'index', ExampleMiddleware::class]);
Routes::get(["/teste/{id}", 'GET', ApiController::class, 'getById']);
Routes::post(["/teste/{id}", 'POST', ApiController::class, 'create']);
Routes::put(["/teste/{id}", 'PUT', ApiController::class, 'updateById']);
Routes::delete(["/teste/{id}", 'DELETE', ApiController::class, 'deleteById']);

