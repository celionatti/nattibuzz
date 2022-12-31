<?php

declare(strict_types=1);

namespace Core;

use PHPMailer\PHPMailer\PHPMailer;

defined('ROOT_PATH') or exit('Access Denied!');

class Mailer
{
    public $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
    }

    public function send()
    {

    }
}
