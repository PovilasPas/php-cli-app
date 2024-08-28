<?php

class GreaterThanValidator extends Validator {
    private int|float $minVal;
    public function __construct(int|float $minVal, string $message = "") {
        parent::__construct([
            "invalid" => $message ? $message : "Value must be greater than %s"
        ]);
        $this->minVal = $minVal;
    }
    public function validate(mixed $value) :int|float {
        if($value <= $this->minVal) {
            throw new ValidationException(sprintf($this->errorMessages["invalid"], $this->minVal));
        }
        return $value;
    }
}