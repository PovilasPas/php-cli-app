<?php

class DonationListState extends State {
    private int $charityId;
    private SelectMenu $menu;
    private DonationsTable $table;
    public function __construct(int $charityId) {
        $this->charityId = $charityId;
    }

    public function initialize(): void {
        $this->menu = new SelectMenu(
            [
                1 => new SelectMenuOption("Add a donation.", new AddDonationState($this->charityId)),
                2 => new SelectMenuOption("Back.", new CharityListState())
            ]
        );
        $this->table = new DonationsTable($this->context, $this->charityId);
    }

    public function render() :void {
        $this->table->render();
        echo PHP_EOL;
        $selected = $this->menu->getSelection();
        $this->context->changeState($selected);
    }
}