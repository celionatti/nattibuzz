<?php

declare(strict_types=1);

namespace App\controllers;

use Core\Controller;
use App\models\Articles;
use Core\Helpers;

defined('ROOT_PATH') or exit('Access Denied!');

class Pages extends Controller
{
    public function report()
    {
        $view = [

        ];
        $this->view->render('pages/report', $view);
    }

    public function advertisement()
    {
        $view = [

        ];
        $this->view->render('pages/advertisement', $view);
    }
}
