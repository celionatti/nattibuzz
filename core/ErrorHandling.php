<?php 

declare(strict_types=1);

namespace Core;

use Exception;
use ErrorException;

defined('ROOT_PATH') or exit('Access Denied!');

class ErrorHandling
{
    /**
 * Error Handler. Convert all errors to exception by throwing an 
 * ErrorException
 *
 * @return void
 */
    public static function errorHandler($severity, $message, $file, $line)
    {
        if (!error_reporting() !== 0) {
            return;
        }
        throw new ErrorException($message, 0, $file, $line);
    }

    /**
     * Exception handler.
     *
     * @param Exception $exception The exception
     * @return void
     * @throws Exception
     */
    public static function exceptionHandler($exception)
    {
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        $error = true;
        if ($error) {
            echo "<div style='font-size: 7px; font-weight:normal'>";
            echo "<h1>Fatal Error</h1>";
            echo "<p>Uncaught exception: " . get_class($exception) . "</p>";
            echo "<p>Message: " . $exception->getMessage() . "</p>";
            echo "<p>Stack trace: " . $exception->getTraceAsString() . "</p>";
            echo "<p>Thrown in " . $exception->getFile() . " on line " . $exception->getLine() . "</p>";
            echo "</div>";
        } else {
            $errorLog = LOG_DIR . "/" . date("Y-m-d H:is") . ".txt";
            ini_set('error_log', $errorLog);
            $message = "Uncaught exception: " . get_class($exception);
            $message .= "with message " . $exception->getMessage();
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in " . $exception->getFile() . " on line " . $exception->getLine();

            error_log($message);

            echo (new View)->render("error/{$code}.php", ["error_message" => $message]);
        }
    }
}