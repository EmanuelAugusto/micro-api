<?php

namespace App\Services;

use App\Repository\ExampleRepository;
use Core\Requests\Request;

class ExampleService
{

    private $repositoryExample;

    function __construct(ExampleRepository $repositoryInject)
    {
        $this->repositoryExample = $repositoryInject;
    }

    public function getFoo(): array
    {
        return $this->repositoryExample->getFooArrayList();
    }

    public function getFooById($id)
    {
        $data = $this->repositoryExample->getFooById($id);

        return $data;
    }
}
