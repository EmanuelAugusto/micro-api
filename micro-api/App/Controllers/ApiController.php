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

    public function index(Request $request, $id = null): string
    {
        return $this->sendJson($this->serviceExample->getFoo(), 200, [
            'Cache-Control: no-store'
        ]);
    }

    public function getById(Request $request): string
    {

        return $this->sendJson(['userName' => 'emanuel'], 200);
    }
}
