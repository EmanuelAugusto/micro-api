<?php

namespace Core\Models;

class Model
{
    public $table = "";
    public $connection = null;

    const HOST = '';
    const PORT = '';
    const DATABASE = '';
    const USER = '';
    const PASSWORD = '';

    public function __construct()
    {
        $this->connection = new \PDO("mysql:host=". self::HOST .";port=". self::PORT .";dbname=". self::DATABASE, 
                                      self::USER, 
                                      self::PASSWORD);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function Create(array $params = []) : bool
    {
    
        $columns = "";
        $values = "";
        
        foreach ($params as $key => $value) {
            $columns .= " $key,";
            $values .= "' $value',";
        }
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');

        $query = "INSERT INTO $this->table ($columns) VALUES($values)";
        $result = $this->connection->exec($query);

        return $result ? true : false;
    }

    public function Get(array $params = [])
    {
        $query = $this->connection->prepare('SELECT * FROM '. $this->table .'WHERE 1');
        $query->execute();

        $result = $query->setFetchMode(\PDO::FETCH_ASSOC);

        $result = $query->fetchObject();

        var_dump($result);
        die();
    }
}
