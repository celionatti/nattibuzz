<?php

declare(strict_types=1);

namespace Core;

defined('ROOT_PATH') or exit('Access Denied!');

class Request
{
    public function isPost()
    {
        return $this->getRequestMethod() === 'POST';
    }

    public function isPut()
    {
        return $this->getRequestMethod() === 'PUT';
    }

    public function isGet()
    {
        return $this->getRequestMethod() === 'GET';
    }

    public function isDelete()
    {
        return $this->getRequestMethod() === 'DELETE';
    }

    public function isPatch()
    {
        return $this->getRequestMethod() === 'PATCH';
    }

    public function getRequestMethod()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /** get a value from the POST variable **/
    public function post(string $key = '', mixed $default = ''): mixed
    {

        if (empty($key)) {
            return $_POST;
        } elseif (isset($_POST[$key])) {
            return $_POST[$key];
        }

        return $default;
    }

    /** get a value from the FILES variable **/
    public function files(string $key = '', mixed $default = ''): mixed
    {

        if (empty($key)) {
            return $_FILES;
        } elseif (isset($_FILES[$key])) {
            return $_FILES[$key];
        }

        return $default;
    }

    /** get a value from the GET variable **/
    public function get(string $key = '', mixed $default = ''): mixed
    {

        if (empty($key)) {
            return $_GET;
        } elseif (isset($_GET[$key])) {
            return $_GET[$key];
        }

        return $default;
    }

    /** get a value from the REQUEST variable **/
    public function input(string $key, mixed $default = ''): mixed
    {

        if (isset($_REQUEST[$key])) {
            return $_REQUEST[$key];
        }

        return $default;
    }

    /** get all values from the REQUEST variable **/
    public function all(): mixed
    {
        return $_REQUEST;
    }

    public function getReqBody($input = false)
    {
        if (!$input) {
            $data = [];
            foreach ($_REQUEST as $field => $value) {
                $data[$field] = self::sanitize($value);
            }
            return $data;
        }
        return array_key_exists($input, $_REQUEST) ? self::sanitize($_REQUEST[$input]) : false;
    }

    public static function sanitize($dirty)
    {
        return $dirty;
    }
}