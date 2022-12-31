<?php

namespace Core\validators;

class MaxValidator extends Validator
{
    public function runValidation()
    {
        $value = $this->_obj->{$this->field};
        $pass = strlen($value) <= $this->rule;
        return $pass;
    }
}