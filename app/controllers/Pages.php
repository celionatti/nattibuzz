<?php

declare(strict_types=1);

namespace App\controllers;

use Core\Controller;
use Core\Helpers;

defined('ROOT_PATH') or exit('Access Denied!');

class Pages extends Controller
{
    public function story()
    {
        $view = [

        ];
        $this->view->render('pages/story', $view);
    }

    public function advertisement()
    {
        $view = [

        ];
        $this->view->render('pages/advertisement', $view);
    }
}
