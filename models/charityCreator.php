<?php

class CharityCreator extends ModelCreator {
    public function getFillables(?Model $current = null): array {
        if(!$current) {
            return [
                "name" => "Name: ",
                "email" => "Email: "
            ];
        }
        if($current && $current instanceof Charity) {
            return [
                "name" => "Name (currently=" . $current->getName() . "): ",
                "email" => "Email (currently=" . $current->getEmail() . "): "
            ];
        }
        throw new InvalidArgumentException("Incorrect model type passed to CharityCreator's getFillables() method.");
    }

    protected function mergeFields(array $fields, Model $model): array {
        if(!$model instanceof Charity) {
            throw new InvalidArgumentException("Incorrect model type passed to CharityCreator's createOrUpdate() method.");
        }
        $fields["name"] = $fields["name"] ? $fields["name"] : $model->getName();
        $fields["email"] = $fields["email"] ? $fields["email"] : $model->getEmail();
        return $fields;
    }

    protected function createModel(array $fields) :Model {
        return new Charity(...$fields);
    }

    protected function getValidator(): CompositeValidator {
        return new CompositeValidator(
            [
                "name" => [
                    new SequentialValidator(
                        [
                            new RequiredValidator("Name field is required."),
                            new RegexValidator(
                                "/^[\p{L}\d _-]{5,255}$/u",
                                "Invalid charity name. Name should contain between 5 and 255 characters. Allowed characters are letters, numbers, spaces, underscores and hyphens."
                            )
                        ]
                    )
                ],
                "email" => [
                    new SequentialValidator(
                        [
                            new RequiredValidator("Email field is required"),
                            new EmailValidator()
                        ]
                    )
                ]
            ]
        );
    }
}