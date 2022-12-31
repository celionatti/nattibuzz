<?php

declare(strict_types=1);

namespace Core;

defined('ROOT_PATH') or exit('Access Denied!');

class Controller
{
    public $view, $request;

    public function __construct()
    {
        $this->view = new View();
        $this->view->setLayout(Config::get('default_layout'));
        $this->request = new Request();
        $this->onConstruct();
    }

    public function jsonResponse($resp)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code(200);
        echo json_encode($resp);
        exit;
    }

    public function onConstruct()
    {
    }
}