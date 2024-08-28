<?php

abstract class Validator {
    protected array $errorMessages;

    public function __construct(array $messages = []) {
        $this->errorMessages = $messages;
    }
    public abstract function validate(mixed $value): mixed;
}