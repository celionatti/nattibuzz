<?php 

require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/dotenv/Dotenv.php');
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/dotenv/Exception/ExceptionInterface.php');
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/dotenv/Exception/FormatException.php');
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/dotenv/Exception/FormatExceptionContext.php');
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/dotenv/Exception/PathException.php');

// PHPMailer
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/PHPMailer/PHPMailer/PHPMailer.php');
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/PHPMailer/PHPMailer/SMTP.php');
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/PHPMailer/PHPMailer/Exception.php');
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/PHPMailer/PHPMailer/POP3.php');

spl_autoload_register(function($className){
    $parts = explode('\\', $className);
    $class = end($parts);
    array_pop($parts);
    $path = strtolower(implode(DIRECTORY_SEPARATOR, $parts));
    $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $class . '.php';
    if (file_exists($path))
    {
        require($path);
    }
});