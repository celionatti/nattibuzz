<?php

declare(strict_types=1);

namespace Core;

defined('ROOT_PATH') or exit('Access Denied!');

class Helpers
{
    public static function dnd($data = [], $die = true): void
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        if ($die) {
            die;
        }
    }
}