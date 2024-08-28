<?php

class SequentialValidator extends Validator {
    private array $validators;
    public function __construct(array $validators) {
        parent::__construct();
        $this->validators = $validators;
    }
    public function validate(mixed $value): mixed {
        $result = $value;
        foreach($this->validators as $validator) {
            $result = $validator->validate($result);
        }
        return $result;
    }
}