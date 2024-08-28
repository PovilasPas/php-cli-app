<?php

class MainMenuState extends State {
    private SelectMenu $menu;

    public function initialize(): void {
        $this->menu = new SelectMenu(
            [
                1 => new SelectMenuOption("View charities.", new CharityListState()),
                2 => new SelectMenuOption("Exit.", new ExitState())
            ]
        );
    }

    public function render() :void {
        $selected = $this->menu->getSelection();
        $this->context->changeState($selected);
    }
}