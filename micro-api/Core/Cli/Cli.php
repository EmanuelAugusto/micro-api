<?php

namespace Core\Cli;

use Core\Routes\Routes;

class Cli
{

    public static function list_routes()
    {
        $routes = Routes::getRoutes();


        foreach ($routes as $value) {
            echo "\n METHOD: $value[1] | PATH: $value[0] | CONTROLLER: $value[2] | FUNCTION: $value[3]  \n ";
        }
    }

    public static function list_tables()
    {
        $data = \Core\Db\Db::raw('show tables')->find();

        print_r($data);
    }

    public static function db_consult($argv)
    {

        $query = $argv[2];

        $data = \Core\Db\Db::raw($query)->find();

        print_r($data);
    }

    public static function help()
    {

        $data = [
            [
                "comando: db_consult", 
                "explicação: recupera informações do banco de dados via cli"
            ],
            [
                "comando: list_tables", 
                "explicação: lista todas as tabelas"
            ],
            [
                "comando: create_controller", 
                "explicação: cria um controller"
            ],
            [
                "comando: list_routes", 
                "explicação: lista todas as rotas da aplicaçao"
            ]
        ];

        foreach ($data as $key => $value) {
            echo "$value[0] \n $value[1] \n";
        }
    }


    public static function create_controller($argv)
    {

        $name = $argv[2];

        file_put_contents("App/Controllers/$name.php", "<?php

namespace App\Controllers;
        
use Core\Responses\Responses;
use App\Controllers\Controller;
        
class $name extends Controller
{
    
}");
    }

    public function Run($argv)
    {
        try {
            $comand = $argv[1] ?? null;

            if(!$comand){
                throw new \Exception("error");
            }

            self::$comand($argv);
        } catch (\Throwable $th) {
            echo "COMAND NOT FOUND IN CLI \n";
        }
    }
}
