<?php

declare(strict_types=1);

namespace App\controllers;
use Core\Controller;


defined('ROOT_PATH') or exit('Access Denied!');

class Timelines extends Controller
{
    public function index()
    {
        $view = [

        ];
        $this->view->render('pages/timelines', $view);
    }

}
