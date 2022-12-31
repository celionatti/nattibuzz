<?php 

declare(strict_types=1);

namespace Core;

defined('ROOT_PATH') or exit('Access Denied!');

class Form
{
    public static function inputField($label, $id, $value, $inputAttrs = [], $wrapperAttrs = [], $errors = [])
    {
        $wrapperStr = self::processAttrs($wrapperAttrs);
        $inputAttrs = self::appendErrors($id, $inputAttrs, $errors);
        $inputAttrs = self::processAttrs($inputAttrs);
        $errorMsg = array_key_exists($id, $errors) ? $errors[$id] : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<input id='{$id}' name='{$id}' value='{$value}' {$inputAttrs} placeholder='{$label}' />";
        $html .= "<label for='{$id}'>{$label}</label>";
        $html .= "<div class='invalid-feedback'>{$errorMsg}</div></div>";
        return $html;
    }

    public static function selectField($label, $id, $value, $options, $inputAttrs = [], $wrapperAttrs = [], $errors = [])
    {
        $inputAttrs = self::appendErrors($id, $inputAttrs, $errors);
        $inputAttrs = self::processAttrs($inputAttrs);
        $wrapperStr = self::processAttrs($wrapperAttrs);
        $errorMsg = array_key_exists($id, $errors) ? $errors[$id] : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<label for='{$id}'>{$label}</label>";
        $html .= "<select id='{$id}' name='{$id}' {$inputAttrs}>";
        foreach ($options as $val => $display) {
            $selected = $val == $value ? ' selected ' : "";
            $html .= "<option value='{$val}'{$selected}>{$display}</option>";
        }
        $html .= "</select>";
        $html .= "<div class='invalid-feedback'>{$errorMsg}</div></div>";
        return $html;
    }

    public static function checkField($label, $id, $checked = '', $inputAttrs = [], $wrapperAttrs = [], $errors = [])
    {
        $inputAttrs = self::appendErrors($id, $inputAttrs, $errors);
        $wrapperStr = self::processAttrs($wrapperAttrs);
        $inputStr = self::processAttrs($inputAttrs);
        $checkedStr = $checked == 'on' ? "checked" : "";
        $errorMsg = array_key_exists($id, $errors) ? $errors[$id] : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<input type=\"checkbox\" id=\"{$id}\" name=\"{$id}\" {$inputStr} {$checkedStr}>";
        $html .= "<label class=\"form-check-label text-black\" for=\"{$id}\">{$label}</label>";
        $html .= "<div class='invalid-feedback'>{$errorMsg}</div></div>";
        return $html;
    }

    public static function textareaField($label, $id, $value, $inputAttrs = [], $wrapperAttrs = [], $errors = [])
    {
        $wrapperStr = self::processAttrs($wrapperAttrs);
        $inputAttrs = self::appendErrors($id, $inputAttrs, $errors);
        $inputAttrs = self::processAttrs($inputAttrs);
        $errorMsg = array_key_exists($id, $errors) ? $errors[$id] : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<label for='{$id}'>{$label}</label>";
        $html .= "<textarea id='{$id}' name='{$id}' value='{$value}' {$inputAttrs} placeholder='{$label}'>{$value}</textarea>";
        $html .= "<div class='invalid-feedback'>{$errorMsg}</div></div>";
        return $html;
    }

    public static function fileField($label, $id, $input = [], $wrapper = [], $errors = [])
    {
        $inputAttrs = self::appendErrors($id, $input, $errors);
        $wrapperStr = self::processAttrs($wrapper);
        $inputStr = self::processAttrs($inputAttrs);
        $errorMsg = array_key_exists($id, $errors) ? $errors[$id] : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<label for=\"{$id}\">{$label}</label>";
        $html .= "<input type=\"file\" id=\"{$id}\" name=\"{$id}\" {$inputStr}/>";
        $html .= "<div class=\"invalid-feedback\">{$errorMsg}</div></div>";
        return $html;
    }

    public static function appendErrors($key, $inputAttrs, $errors)
    {
        if (array_key_exists($key, $errors)) {
            if (array_key_exists('class', $inputAttrs)) {
                $inputAttrs['class'] .= ' is-invalid';
            } else {
                $inputAttrs['class'] = 'is-invalid';
            }
        }
        return $inputAttrs;
    }

    public static function processAttrs($attrs)
    {
        $html = "";
        foreach ($attrs as $key => $value) {
            $html .= " {$key}='{$value}'";
        }
        return $html;
    }

    public static function csrfField()
    {
        $token = Session::createCsrfToken();
        $html = "<input type='hidden' value='{$token}' name='_token' />";
        return $html;
    }
}