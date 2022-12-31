<?php

declare(strict_types=1);

namespace App\controllers;

use Core\Router;
use Core\Helpers;
use Core\Session;
use Core\Controller;
use App\models\Users;
use Core\Application;
use Core\helpers\Token;

defined('ROOT_PATH') or exit('Access Denied!');

class Auth extends Controller
{
    public function onConstruct()
    {
        $this->view->setLayout('auth');
    }

    public function register()
    {
        if (Application::$app->currentUser) {
            Router::redirect('');
        }

        if(isset($_GET['ref'])) {
            $ref = esc($_GET['ref']);
        }

        $user = new Users();

        if($this->request->isPost()) {
            Session::csrfCheck();
            $fields = ['fname', 'lname', 'email', 'password', 'confirm_password'];
            foreach ($fields as $field) {
                $user->{$field} = esc($this->request->getReqBody($field));
            }
            $user->username = "@" . str_lower($user->fname) . '_' . str_lower($user->lname);
            $user->acl = 'user';
            $user->ref_uid = str_lower($user->fname) . '_' . str_lower($user->lname) . Token::RandomNumber(5);
            $user->refer_by = str_lower($ref) ?? null;
            if ($user->save()) {
                Session::msg("Account Created Successfully!. You're welcome.", "success");
                Router::redirect('auth/login');
            }
        }


        $view = [
            'errors' => $user->getErrors(),
            'user' => $user
        ];
        $this->view->render('pages/auth/register', $view);
    }

    public function login()
    {
        if (Application::$app->currentUser) {
            Router::redirect('');
        }

        $user = new Users();
        $isError = true;

        if($this->request->isPost()) {
            Session::csrfCheck();
            $user->email = $this->request->getReqBody('email');
            $user->password = $this->request->getReqBody('password');
            $user->remember = $this->request->getReqBody('remember');
            $user->validateLogin();
            if (empty($user->getErrors())) {
                //continue with the login process
                $u = Users::findFirst(
                    [
                        'conditions' => "email = :email",
                        'bind' => ['email' => $this->request->getReqBody('email')]
                    ]
                );
                if ($u) {
                    $verified = password_verify($this->request->getReqBody('password'), $u->password);
                    if ($verified) {
                        //log the user in
                        $isError = false;
                        $remember = $this->request->getReqBody('remember') == 'on';
                        $u->login($remember);
                        Router::redirect('');
                    }
                }
            }
            if ($isError) {
                $user->setError('email', 'Something is wrong with the Email or Password. Please try again.');
                $user->setError('password', '');
            }
        }

        $view = [
            'errors' => $user->getErrors(),
            'user' => $user
        ];
        $this->view->render('pages/auth/login', $view);
    }

    public function logout()
    {
        if (Application::$app->currentUser) {
            Application::$app->currentUser->logout();
        }
        Router::redirect('');
    }

    public function forgot_password()
    {
        $view = [
            'errors' => [],
            'user' => ['remember' => 0]
        ];
        $this->view->render('pages/auth/forgot_password', $view);
    }
}
