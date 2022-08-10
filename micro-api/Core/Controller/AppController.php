<?php

namespace Core\Controller;

use Core\Requests\Request;
use App\Routes\Routes;

class AppController
{

    use \Core\Responses\Responses;

    private $Routes;

    public function __construct()
    {
        $this->Routes = Routes::RoutesList();
    }

    public function Run()
    {

        foreach ($this->Routes as $key => $value) {
            $this->add($value[0], $value);
        }

        echo $this->sendJson(['error' => 'Not Found'], 404);
        exit;
    }

    private function createInstance($file, $params)
    {
        $class = $file[2];
        $method = $file[3];

        $classRoute = $this->factoryClass($class);

        $request = new Request;

        echo $classRoute->{$method}($request, ...array_values($params));
        exit;
    }

    private function factoryClass($class)
    {

        $reflectionClass = new \ReflectionClass($class);

        $constructor = $reflectionClass->getConstructor();

        $argsClassConstructor = [];

        if (!$constructor) {
            return new $class();
        }

        $parameters = $constructor->getParameters();

        foreach ($parameters as $parameter) {

            $className = $this->factoryClass($parameter->getClass()->name);

            if ($className) {
                array_push($argsClassConstructor, $className);
            }
        }

        return new $class(...$argsClassConstructor);
    }

    private function simpleRoute($file, $route)
    {

        if (!empty($_SERVER['REQUEST_URI'])) {
            $route = preg_replace("/(^\/)|(\/$)/", "", $route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/", "", $_SERVER['REQUEST_URI']);
        } else {
            $reqUri = "/";
        }

        if ($reqUri == $route) {
            $params = [];

            $this->createInstance($file, $params);

            exit();
        }
    }

    function add($route, $file)
    {

        $params = [];

        $paramKey = [];

        preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

        if (empty($paramMatches[0])) {
            $this->simpleRoute($file, $route);
            return;
        }

        foreach ($paramMatches[0] as $key) {
            $paramKey[] = $key;
        }

        if (!empty($_SERVER['REQUEST_URI'])) {
            $route = preg_replace("/(^\/)|(\/$)/", "", $route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/", "", $_SERVER['REQUEST_URI']);
        } else {
            $reqUri = "/";
        }

        $uri = explode("/", $route);

        $indexNum = [];

        foreach ($uri as $index => $param) {
            if (preg_match("/{.*}/", $param)) {
                $indexNum[] = $index;
            }
        }

        $reqUri = explode("/", $reqUri);

        foreach ($indexNum as $key => $index) {

            if (empty($reqUri[$index])) {
                return;
            }

            $params[$paramKey[$key]] = $reqUri[$index];

            $reqUri[$index] = "{.*}";
        }

        $reqUri = implode("/", $reqUri);

        $reqUri = str_replace("/", '\\/', $reqUri);

        $httpMethod = $_SERVER['REQUEST_METHOD'];

        if (preg_match("/$reqUri/", $route) && $httpMethod === $file[1]) {
            $this->createInstance($file, $params);
            exit();
        }
    }

}
