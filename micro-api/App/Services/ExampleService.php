<?php

namespace App\Services;

use App\Repository\ExampleRepository;

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
}
