<?php

declare(strict_types=1);

namespace Core;

defined('ROOT_PATH') or exit('Access Denied!');

class Session
{
    /** activate session if not yet started **/
    private static function start_session(): int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return 1;
    }

    public static function exists($name)
    {
        self::start_session();

        return isset($_SESSION[$name]);
    }

    public static function set($name, $value)
    {
        self::start_session();

        $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        self::start_session();

        if (self::exists($name) && !empty($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return false;
    }

    public static function delete($name)
    {
        self::start_session();

        unset($_SESSION[$name]);
    }

    public static function createCsrfToken()
    {
        $token = bin2hex(random_bytes(12));
        self::set('_token', $token);
        return $token;
    }

    public static function csrfCheck()
    {
        $request = new Request();
        $check = $request->post('_token');
        if (self::exists('_token') && self::get('_token') == $check) {
            return true;
        }
        Router::redirect('errors/403');
    }

    // $type can be primary, secondary, success, danger, warning, info, light, dark
    public static function msg($msg, $type = 'danger')
    {
        $alerts = self::exists('session_alerts') ? self::get('session_alerts') : [];
        $alerts[$type][] = $msg;
        self::set('session_alerts', $alerts);
    }

    public static function displaySessionAlerts()
    {
        $alerts = self::exists('session_alerts') ? self::get('session_alerts') : [];
        $html = "";
        foreach ($alerts as $type => $msgs) {
            foreach ($msgs as $msg) {
                $html .= "<div class='alert alert-{$type} alert-dismissible fade show mt-3 mx-2 shadow-lg fixed-top text-uppercase text-center' role='alert' style='z-index: 5000;'>
                    {$msg}
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
        self::delete('session_alerts');
        return $html;
    }
}
