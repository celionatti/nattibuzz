<?php

declare(strict_types=1);

namespace Core;

use ErrorException;
use RuntimeException;

defined('ROOT_PATH') or exit('Access Denied!');

class Router
{
    private $controller = "Home";
    private $method = 'index';

    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", trim($URL, "/"));
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitURL();

        /** select controller **/
        $filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        } else {

            $filename = "../app/controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }

        $controller = new ('\App\controllers\\' . $this->controller);

        /** select method **/
        if (!empty($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }

        call_user_func_array([$controller, $this->method], $URL);

    }

    public static function redirect($location)
    {
        if (!headers_sent()) {
            header('Location: ' . ROOT . $location);
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "'.ROOT.$location. '"';
            echo '</script>';
            echo '<script>';
            echo '<meta http-equiv="refresh" content="0;url='.ROOT.$location. '" />';
            echo '</script>';
        }
        exit();
    }

    public static function lastURL()
    {
        if (!headers_sent()) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }
    }
}