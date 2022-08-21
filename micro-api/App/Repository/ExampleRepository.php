<?php

namespace App\Repository;

use Core\Db\Db;
use App\Models\User;

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

    public function getByIdOrm($id, $request)
    {
        $query = User::query()->where("id", $id)->where('login', $request->Input("login"))->get();

        return $query;
    }
}
