<?php

namespace App\Repository;


class ExampleRepository
{

    public function getFooArrayList(): array
    {
        return [
            ['foo' => 'bar'],
            ['foo' => 'bar'],
            ['foo' => 'bar'],
        ];
    }
}
