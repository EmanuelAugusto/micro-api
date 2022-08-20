<?php

require_once './vendor/autoload.php';

use Core\Controller\AppController;
use Core\Routes\Routes;
use App\Controllers\ApiController;
use App\Middlewares\ExampleMiddleware;

Routes::get(["/teste", 'GET', ApiController::class, 'index', ExampleMiddleware::class]);
Routes::get(["/teste/{id}", 'GET', ApiController::class, 'getById']);
Routes::post(["/teste/{id}", 'POST', ApiController::class, 'create']);
Routes::put(["/teste/{id}", 'PUT', ApiController::class, 'updateById']);
Routes::delete(["/teste/{id}", 'DELETE', ApiController::class, 'deleteById']);


var_dump(Routes::getRoutes());

//$App = new AppController;
//$App->Run();