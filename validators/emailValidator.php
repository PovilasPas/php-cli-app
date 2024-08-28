<?php

class EmailValidator extends Validator {
    // protected array $errorMessages = [
    //     "invalid" => "Invalid email address."
    // ];
    public function __construct() {
        parent::__construct([
            "invalid" => "Invalid email address."
        ]);
    }

    public function validate(mixed $value) :string {
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException($this->errorMessages["invalid"]);
        }
        return $value;
    }
}