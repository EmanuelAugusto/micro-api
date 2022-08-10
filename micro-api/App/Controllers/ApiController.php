<?php

namespace App\Controllers;

use Core\Requests\Request;
use App\Controllers\Controller;
use App\Services\ExampleService;

class ApiController extends Controller
{

    private $serviceExample;

    function __construct(ExampleService $serviceInject)
    {

        $this->serviceExample = $serviceInject;
    }

    public function index(Request $request, $id = null)
    {
        return $this->sendJson($this->serviceExample->getFoo(), 200, [
            'Cache-Control: no-store'
        ]);
    }

    public function getById(Request $request)
    {

        return $this->sendJson(['service' => 'getById'], 200);
    }

    public function create(Request $request)
    {

        return $this->sendJson(['service' => 'create'], 200);
    }

    public function updateById(Request $request)
    {

        return $this->sendJson(['service' => 'updateById'], 200);
    }

    public function deleteById(Request $request)
    {

        return $this->sendJson(['service' => 'deleteById'], 200);
    }
}
