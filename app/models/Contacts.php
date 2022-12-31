<?php

declare(strict_types=1);

namespace App\models;

use Core\Model;
use Core\Config;
use Core\Cookie;
use Core\Session;
use Core\helpers\Token;
use Core\Helpers;
use Core\helpers\StringFormat;
use Core\validators\EmailValidator;
use Core\validators\UniqueValidator;
use Core\validators\RequiredValidator;

defined('ROOT_PATH') or exit('Access Denied!');

class Contacts extends Model
{
    protected static $table = "contacts";
    public $id, $slug, $fullname, $email, $subject, $message, $created_at, $updated_at;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'fullname', 'msg' => "Full Name is a required field."]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'subject', 'msg' => "Subject is a required field."]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'message', 'msg' => "Message is a required field."]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => "E-Mail is a required field."]));
        $this->runValidation(new EmailValidator($this, ['field' => 'email', 'msg' => "You must provide a valid E-mail."]));
        
        $this->runValidation(new UniqueValidator($this, ['field' => 'slug', 'msg' => "Slug already exists."]));

        if ($this->isNew()) {
            $this->slug = Token::randomString(30);
        } else {
            $this->_skipUpdate = ['slug'];
        }
    }

}