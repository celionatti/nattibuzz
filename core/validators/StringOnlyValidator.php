<?php

namespace Core\validators;

class StringOnlyValidator extends Validator
{
    public function runValidation()
    {
        $value = $this->_obj->{ $this->field};
        $pass = true;
        if (!empty($value)) {
            $pass = preg_match("/^[a-zA-Z]+$/", $value);
        }
        return $pass;
    }
}