<?php

namespace App\Repository;

use Core\Db\Db;

class ExampleRepository
{

    public function getFooArrayList()
    {
        return Db::raw("select * from users")->find();
    }

    public function getFooById($id)
    {

        $data = Db::raw("select * from users where id = :id")->findOneOrFail([
            'id' => $id
        ]);

        return $data;

    }
}
