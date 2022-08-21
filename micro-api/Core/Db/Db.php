<?php

namespace Core\Db;


class Db
{

    public $connection = null;

    private static $instances = [];

    private $query = "";

    protected function __wakeup()
    {
        throw new \Exception('cannot_unserialize_a_singleton.');
    }

    private static function getInstance()
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

            self::getInstance()->connection = new \PDO(
                "mysql:host=" . $credentials['HOST'] . ";port=" . $credentials['PORT'] . ";dbname=" . $credentials['DATABASE'],
                $credentials['USER'],
                $credentials['PASSWORD']
            );
            self::getInstance()->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$instances[$class];
    }

    public static function raw($query)
    {

        self::getInstance()->query = $query;


        return self::getInstance();
    }

    public function find($params = [])
    {

        $queryCon = self::getInstance()->connection->prepare($this->query);
        $queryCon->execute($params);

        $result = $queryCon->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function findOne($params = [])
    {

        $queryCon = self::getInstance()->connection->prepare($this->query);
        $queryCon->execute($params);

        $result = $queryCon->fetch(\PDO::FETCH_ASSOC);

        return $result ? $result : null;
    }

    public function findOneOrFail($params = [])
    {

        $queryCon = self::getInstance()->connection->prepare($this->query);
        $queryCon->execute($params);

        $result = $queryCon->fetch(\PDO::FETCH_ASSOC);

        if($result){
            return $result;
        }else{
            throw new \Exception("not_found", 404);
        }   
    }
}
