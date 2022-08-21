<?php

namespace App\Middlewares;

use Core\Middleware\IMiddleware;

class ExampleMiddleware implements IMiddleware
{

    use \Core\Responses\Responses;

    public function handler($request, $handler = null){
  
        if($request->Input('user') === 'emanuel'){
            return $request;
        }else{
            throw new \Exception("unauthorized", 401);
        }
    }
}