<?php 

declare(strict_types=1);

namespace App\models;

use Core\Router;
use Core\Session;
use App\models\Users;


defined('ROOT_PATH') or exit('Access Denied!');

class Permission
{
    public static function permRedirect($perm, $redirect, $msg = "You do not have access to this page.")
    {
        $user = Users::getCurrentUser();
        $allowed = $user && $user->hasPermission($perm);
        if (!$allowed) {
            Session::msg($msg);
            Router::redirect($redirect);
        }
    }
}