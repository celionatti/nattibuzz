<?php

declare(strict_types=1);

namespace App\controllers;

use Core\Controller;

defined('ROOT_PATH') or exit('Access Denied!');

class Policy extends Controller
{
    public function terms()
    {
        $view = [
            
        ];
        $this->view->render('pages/policy/terms', $view);
    }

    public function content()
    {
        $view = [
            
        ];
        $this->view->render('pages/policy/content', $view);
    }
}