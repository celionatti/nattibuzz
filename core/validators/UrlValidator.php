<?php

namespace Core\validators;

class UrlValidator extends Validator
{
    public function runValidation()
    {
        $url = $this->_obj->{$this->field};
        $pass = true;
        if (!empty($url)) {
            $pass = filter_var($url, FILTER_VALIDATE_URL);
        }
        return $pass;
    }
}