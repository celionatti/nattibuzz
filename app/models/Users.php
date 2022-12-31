<?php

declare(strict_types=1);

namespace App\models;

use Core\Model;
use Core\Config;
use Core\Cookie;
use Core\Session;
use Core\helpers\Token;
use App\models\UserSessions;
use Core\Helpers;
use Core\validators\MinValidator;
use Core\validators\EmailValidator;
use Core\validators\UniqueValidator;
use Core\validators\MatchesValidator;
use Core\validators\RequiredValidator;

defined('ROOT_PATH') or exit('Access Denied!');

class Users extends Model
{
    protected static $table = "users";
    protected static $_current_user = false;

    public $resetPassword = false;

    public $id, $uid, $created_at, $updated_at, $fname, $lname, $username, $img, $email, $password, $phone, $acl, $ref_uid = null, $refer_by = null, $blocked = 0, $confirm_password = '', $remember = '', $old_password;

    const USER_PERMISSION = 'user';
    const AUTHOR_PERMISSION = 'author';
    const ADMIN_PERMISSION = 'admin';
    const MANAGER_PERMISSION = 'manager';

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'fname', 'msg' => "First Name is a required field."]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'lname', 'msg' => "Last Name is a required field."]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'username', 'msg' => "Username is a required field."]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => "Email is a required field."]));
        $this->runValidation(new EmailValidator($this, ['field' => 'email', 'msg' => 'You must provide a valid email.']));
        $this->runValidation(new UniqueValidator($this, ['field' => ['email', 'acl', 'lname'], 'msg' => 'A user with that email address already exists.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'acl', 'msg' => "Access Level is a required field."]));

        if ($this->isNew() || $this->resetPassword) {
            $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'msg' => "Password is a required field."]));
            $this->runValidation(new RequiredValidator($this, ['field' => 'confirm_password', 'msg' => "Confirm Password is a required field."]));
            $this->runValidation(new MatchesValidator($this, ['field' => 'confirm_password', 'rule' => $this->password, 'msg' => "Your passwords do not match."]));
            $this->runValidation(new MinValidator($this, ['field' => 'password', 'rule' => 8, 'msg' => "Password must be at least 8 characters."]));

            $this->password = password_hash($this->password, PASSWORD_DEFAULT, ['cost' => 12]);
            $this->uid = Token::randomString(60);
        } else {
            $this->_skipUpdate = ['password'];
        }
    }

    public function validateLogin()
    {
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => "Email is a required field."]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'msg' => "Password is a required field."]));
    }

    public function validateChangePassword()
    {
        $this->runValidation(new RequiredValidator($this, ['field' => 'old_password', 'msg' => "Old Password is a required field."]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'new_password', 'msg' => "New Password is a required field."]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'confirm_password', 'msg' => "Confirm Password is a required field."]));
    }

    public function login($remember = false)
    {
        Session::set('logged_in_user', $this->uid);
        self::$_current_user = $this;
        if ($remember) {
            $now = time();
            $newHash = md5("{$this->id}_{$now}");
            $session = UserSessions::findByUserId($this->uid);
            if (!$session) {
                $session = new UserSessions();
            }
            $session->user_id = $this->uid;
            $session->hash = $newHash;
            $session->save();
            Cookie::set(Config::get('LOGIN_TOKEN'), $newHash, 60 * 60 * 24 * 30);
        }
    }

    public static function loginFromCookie()
    {
        $cookieName = Config::get('LOGIN_TOKEN');
        if (!Cookie::exists($cookieName))
            return false;
        $hash = Cookie::get($cookieName);
        $session = UserSessions::findByHash($hash);
        if (!$session)
            return false;
        $user = self::findFirst([
            'conditions' => "uid = :uid",
            'bind' => ['uid' => $session->user_id]
        ]);
        if ($user) {
            $user->login(true);
        }
    }

    public function logout()
    {
        Session::delete('logged_in_user');
        self::$_current_user = false;
        $session = UserSessions::findByUserId($this->uid);
        if ($session) {
            $session->delete();
        }
        Cookie::delete(Config::get('LOGIN_TOKEN'));
    }

    public static function getCurrentUser()
    {
        if (!self::$_current_user && Session::exists('logged_in_user')) {
            $user_id = Session::get('logged_in_user');
            self::$_current_user = self::findFirst([
                'conditions' => "uid = :uid",
                'bind' => ['uid' => $user_id]
            ]);
        }
        if (!self::$_current_user)
            self::loginFromCookie();
        if (self::$_current_user && self::$_current_user->blocked) {
            self::$_current_user->logout();
            Session::msg("You are currently blocked. Please talk to an admin to resolve this.");
        }
        return self::$_current_user;
    }

    public function hasPermission($acl)
    {
        if (is_array($acl)) {
            return in_array($this->acl, $acl);
        }
        return $this->acl == $acl;
    }

    public function displayName()
    {
        return trim($this->fname . ' ' . $this->lname);
    }
}
