<?php

namespace Core\Models;

use Core\Db\Db;

class Model extends Db
{

    private $constructor = [];

    public static function query()
    {

        $instance = parent::getInstance();

        return $instance;
    }

    public function where($column, $value)
    {
        array_push($this->constructor, [
            $column, $value
        ]);

        return $this;
    }

    public function get()
    {

        $this->query = "select * from $this->table";

        $clause = "";

        $bind = [];

        foreach ($this->constructor as $value) {
            if($clause){
                $clause .= " and $value[0] = :$value[0]";

                $bind[":$value[0]"] = $value[1]; 
            }else{
                $clause .= " where $value[0] = :$value[0]";

                $bind[":$value[0]"] = $value[1]; 
            }
        }

        $this->query = "$this->query $clause";

        $data = $this->find($bind);

        return $data;
    }
}
