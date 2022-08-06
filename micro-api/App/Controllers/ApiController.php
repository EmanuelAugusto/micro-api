<?php

namespace App\Controllers;

use Core\Requests\Request;
use App\Controllers\Controller;

class ApiController extends Controller
{
    public function index(Request $request, $id): string
    {
        return $this->sendJson(['api' => true, 'param' => $id], 200, [
            'Cache-Control: no-store'
        ]);
    }

    public function getById(Request $request): string
    {

        return $this->sendJson(['userName' => 'emanuel'], 200);
    }
}
