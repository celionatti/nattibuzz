<?php 

declare(strict_types=1);

namespace App\controllers;
use Core\Controller;

defined('ROOT_PATH') or exit('Access Denied!');

class _404 extends Controller
{
    public function index()
    {
        $this->view->render('errors/404');
    }
}