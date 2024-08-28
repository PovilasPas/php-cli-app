<?php

class RequiredValidator extends Validator {
    public function __construct(string $message = "") {
        parent::__construct([
            "invalid" => $message ? $message : "Value is required.",
        ]);
    }
    public function validate(mixed $value) :mixed {
        if(!$value) {
            throw new ValidationException($this->errorMessages["invalid"]);
        }
        return $value;
    }
}