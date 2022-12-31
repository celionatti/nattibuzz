<?php 

declare(strict_types=1);

namespace Core;

class Cookie
{
    public static function get($name)
    {
        if (self::exists($name)) {
            return $_COOKIE[$name];
        }
        return false;
    }

    public static function set($name, $value, $expiry)
    {
        $arr = ['expires' => time() + $expiry, 'path' => '/', 'domain' => '', 'secure' => false, 'httponly' => true, 'samesite' => 'lax'];

        if (setCookie($name, $value, $arr)) {
            return true;
        }
        return false;
    }

    public static function delete($name)
    {
        return self::set($name, '', -1);
    }

    public static function exists($name)
    {
        return isset($_COOKIE[$name]);
    }
}