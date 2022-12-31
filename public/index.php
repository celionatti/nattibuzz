<?php

use Core\Application;
use Core\Config;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . "/../vendor/autoload.php";

$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env');

/**
 * =============================================
 * Check php version with the Framework version.
 * =============================================
 */
$minPhpVersion = '7.4'; // If you update this, don't forget to update `spark`.
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your PHP version must be %s or higher to run Native Framework. Current version: %s',
        $minPhpVersion,
        PHP_VERSION
    );

    exit($message);
}

define("ROOT_PATH", __DIR__ . DIRECTORY_SEPARATOR);

require "../core/bootstrap.php";

Config::get('DEBUG') ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$app = new Application();
$app->run();