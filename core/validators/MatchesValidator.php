<?php

namespace Core\validators;

class MatchesValidator extends Validator
{
    public function runValidation()
    {
        $value = $this->_obj->{$this->field};
        return $value == $this->rule;
    }
}