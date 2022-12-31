<?php

declare(strict_types=1);

namespace App\controllers;
use App\models\Subscribers;
use Core\Controller;
use App\models\Articles;


defined('ROOT_PATH') or exit('Access Denied!');

class Home extends Controller
{
    public function index()
    {
        $view = [

        ];
        $this->view->render('pages/home', $view);
    }

    public function subscribers()
    {
        $subscribers = new Subscribers();

        if(isset($_POST['add_subscribers'])) {
            $subscribers->email = esc($this->request->getReqBody('email'));
            $subscribers->status = 'active';

            if($subscribers->save()) {
                $this->jsonResponse("You are now Subscribe to our newsletter");
            } else {
                $this->jsonResponse("Something went wrong.");
            }
        }
    }
}
