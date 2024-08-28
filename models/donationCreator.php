<?php

class DonationCreator extends ModelCreator {
    private int $charityId;
    public function __construct(int $charityId) {
        $this->charityId = $charityId;
    }

    public function getFillables(?Model $current = null): array {
        if(!$current) {
            return [
                "donorName" => "Donor name: ",
                "amount" => "Amount: "
            ];
        }
        if($current && $current instanceof Donation) {
            return [
                "donorName" => "Donor name (currently=" . $current->getDonorName() . "): ",
                "amount" => "Amount (currently=" . $current->getAmount() . "): "
            ];
        }
        throw new InvalidArgumentException("Incorrect model type passed to DonationCreator's getFillables() method.");
    }

    protected function mergeFields(array $fields, Model $model): array {
        if(!$model instanceof Donation) {
            throw new InvalidArgumentException("Incorrect model type passed to DonationCreator's mergeFields() method.");
        }
        $fields["donorName"] = $fields["donorName"] ? $fields["donorName"] : $model->getDonorName();
        $fields["amount"] = $fields["amount"] ? $fields["amount"] : $model->getAmount();
        return $fields;
    }

    protected function createModel(array $fields): Model {
        return new Donation($fields["donorName"], $fields["amount"], $this->charityId);
    }

    protected function getValidator(): CompositeValidator {
        return new CompositeValidator(
            [
                "donorName" => [
                    new SequentialValidator(
                        [
                            new RequiredValidator("Donor name is required."),
                            new RegexValidator("/^[\p{L}\d _-]{5,255}$/u", "Invalid donor name. Name should contain between 5 and 255 characters. Allowed characters are letters, numbers, spaces, underscores and hyphens.")
                        ]
                    )
                ],
                "amount" => [
                    new SequentialValidator(
                        [
                            new RequiredValidator("Donation amount is required."),
                            new RegexValidator("/^[+-]?(\d+(\.\d{0,2})?|\.\d{1,2})$/", "The donation amount is not in an accepted number format."),
                            new GreaterThanValidator(0, "The donation amount should be positive.")
                        ]
                    )
                ]
            ]
        );
    }
}