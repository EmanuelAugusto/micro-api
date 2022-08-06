<?php

namespace App\Controllers;


class ViewController
{
    public static function make(string $ViewName, array $data, bool $template = true)
    {

        foreach ($data as $key => $value) {
            $viewData[$key] = $value;
        }

        $content = file_get_contents(__DIR__ . '/../Views/' . $ViewName . '.view.php');

        ob_start();
        eval("?>$content");
        $result = ob_get_clean();

        $viewData['content'] = $result;

        if(!$template){
            require __DIR__ . '/../Templates/templateWhite.view.php';
            exit;
        }

        require __DIR__ . '/../Templates/template.view.php';
        exit;
    }
}
