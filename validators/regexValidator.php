<?php

class RegexValidator extends Validator {
    protected string $pattern;
    public function __construct(string $pattern, string $message = "") {
        parent::__construct([
            "invalid" => $message ? $message : "Value does not match the pattern."
        ]);
        $this->pattern = $pattern;
    }
    public function validate(mixed $value) :string {
        if(!preg_match($this->pattern, $value)) {
            throw new ValidationException($this->errorMessages["invalid"]);
        }
        return $value;
    }
}