<?php

declare(strict_types=1);

namespace Core;

use App\models\Users;

defined('ROOT_PATH') or exit('Access Denied!');

class Application
{
    public Router $router;
    public Cookie $cookie;
    public Session $session;
    public Mailer $mailer;
    
    public static Application $app;
    public $currentUser = null;

    public function __construct()
    {
        self::$app = $this;
        $this->router = new Router();
        $this->cookie = new Cookie();
        $this->session = new Session();
        $this->mailer = new Mailer();
        $this->currentUser = Users::getCurrentUser();
    }

    /**
     * Define framework and application directory constants
     *
     * @return void
     */
    private function constants(): void
    {
        defined('LOG_DIR') or define('LOG_DIR', ROOT_PATH . DIRECTORY_SEPARATOR . '../' . 'logs');
    }

    /**
     * Set default framework and application settings
     *
     * @return void
     */
    private function environment()
    {
        ini_set('default_charset', 'UTF-8');
    }

    /**
     * Convert PHP errors to exception and set a custom exception
     * handler. Which allows us to take control or error handling
     * so we can display errors in a customizable way
     *
     * @return void
     */
    private function errorHandler(): void
    {
        error_reporting(E_ALL | E_STRICT);
        set_error_handler('Core\ErrorHandling::errorHandler');
        set_exception_handler('Core\ErrorHandling::exceptionHandler');
    }

    public function run()
    {
        $this->constants();
        $this->router->loadController();
        $this->environment();
        $this->errorHandler();
    }
}