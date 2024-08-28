<?php

class CharityListState extends State {
    private SelectMenu $menu;
    private CharitiesTable $table;

    public function initialize(): void {
        $this->menu = new SelectMenu(
            [
                1 => new SelectMenuOption("Add a charity.", new AddCharityState()),
                2 => new SelectMenuOption("Edit a charity.", new CharitySelectionState("edit")),
                3 => new SelectMenuOption("Delete a charity.", new CharitySelectionState("delete")),
                4 => new SelectMenuOption("View charity donations.", new CharitySelectionState("donations")),
                5 => new SelectMenuOption("Import charities from csv.", new ReadCharitiesFromCsvState(new CharityCreator())),
                6 => new SelectMenuOption("Back.", new MainMenuState()),
            ]
        );

        $this->table = $this->table = new CharitiesTable($this->context);
    }
    public function render(): void {
        $this->table->render();
        echo PHP_EOL;
        $selected = $this->menu->getSelection();
        $this->context->changeState($selected);
    }
}