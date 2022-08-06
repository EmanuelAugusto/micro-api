<?php

namespace Core\Controller;

use Core\Requests\Request;
use App\Routes\Routes;

class AppController
{
    public function Run(): void
    {
        $requestPath =  new Request;
        $path =  $requestPath->RoutePath();

        $Routes = Routes::RoutesList();

        $route  = array_filter(
            $Routes,
            function ($key) use ($path) {
                if ($key === $path) {
                    return $key;
                }
            },
            ARRAY_FILTER_USE_KEY
        );

        if (sizeof($route)) {
            $request = new Request;
            $classRoute = new $route[$path][0]();
            $method = $route[$path][1];
            echo $classRoute->{$method}($request);
            exit;
        } else {
            print_r('not_found');
            exit;
        }
    }
}
