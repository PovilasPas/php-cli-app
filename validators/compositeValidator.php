<?php

class CompositeValidator extends Validator {
    private array $validators;
    private array $errors;
    public function __construct(array $validators) {
        parent::__construct();
        $this->validators = $validators;
        $this->errors = [];
    }
    public function validate(mixed $fields): array {
        $validatedFields = [];
        foreach($fields as $key => $item) {
            $fieldValidators = $this->validators[$key];
            if($fieldValidators) {
                $result = $item;
                $fieldErrors = [];
                foreach($fieldValidators as $validator) {
                    try {
                        $result = $validator->validate($result);
                    } catch(ValidationException $e) {
                        array_push($fieldErrors, $e->getMessage());
                    }
                }
                if(count($fieldErrors)) {
                    $this->errors[$key] = $fieldErrors;
                } else {
                    $validatedFields[$key] = $result;
                }
            }
        }
        return $validatedFields;
    }

    public function isValid() :bool {
        return count($this->errors) == 0;
    }

    public function getErrors() :array {
        return $this->errors;
    }

    public function reset() :void {
        $this->errors = [];
    }
}