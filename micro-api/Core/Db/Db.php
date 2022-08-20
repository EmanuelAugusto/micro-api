<?php

namespace Core\Db;


class Db{

    public $connection = null;

    private static $instances = [];


    protected function __wakeup()
    {
        throw new \Exception('cannot_unserialize_a_singleton.');
    }

    public static function getInstance()
    {
        $class = static::class;

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();

            $credentials = [
                'HOST' => 'mysql_db',
                'PORT' => 3306,
                'DATABASE' => 'MICRO',
                'USER' => 'root',
                'PASSWORD' => 'root'
            ];
    
            self::getInstance()->connection = new \PDO("mysql:host=". $credentials['HOST'] .";port=". $credentials['PORT'] .";dbname=". $credentials['DATABASE'], 
            $credentials['USER'], 
            $credentials['PASSWORD']);
            self::getInstance()->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$instances[$class];
    }

    public function raw($query){
        //var_dump($query);
        //die();

        $query = self::getInstance()->connection->prepare($query);
        $query->execute();

        $result = $query->setFetchMode(\PDO::FETCH_ASSOC);

        $result = $query->dba_fetch();


        var_dump($result);
        die();

        return $query;
    }

}