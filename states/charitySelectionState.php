<?php

class CharitySelectionState extends State {
    private string $action;
    private CharitiesTable $table;
    public function __construct(string $action) {
        $this->action = strtolower($action);
    }

    public function initialize(): void {
        $this->table = new CharitiesTable($this->context);
    }

    public function render() :void {
        $this->table->render();
        echo PHP_EOL;
        $id = trim(readline("Select a charity based on id: "));
        if(!$this->context->getCharityContainer()->containsModel($id)) {
            $this->context->changeState(
                new SimpleErrorState(
                    [["Charity with the selected id does not exist."]],
                    new CharityListState(),
                    new CharitySelectionState($this->action)
                ),
            );
            return;
        }
        $actions = [
            "edit" => new EditCharityState($id),
            "delete" => new DeleteCharityState($id),
            "donations" => new DonationListState($id)
        ];
        if(!array_key_exists($this->action, $actions)) {
            throw new InvalidArgumentException("Not a valid action with charity model.");
        }
        $this->context->changeState($actions[$this->action]);
    }
}