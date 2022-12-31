<?php

declare(strict_types=1);

namespace Core\helpers;

use Exception;

defined('ROOT_PATH') or exit('Access Denied!');

class StringFormat
{
    /**
     * Excerpt Function
     *
     * This function helps short Text Content;
     * Accept Two Params
     * @param string $text for the variable to short
     * @param int|string $length for number of length
     *
     * @return string
     */
    public static function Excerpt($text, $length = 15): string
    {
        return substr($text, 0, $length) . '...';
    }

    public static function StrToLower($text)
    {
        return strtolower($text);
    }
}