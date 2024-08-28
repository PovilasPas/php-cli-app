<?php

abstract class ErrorState extends State {
    protected array $errors;
    protected SelectMenu $menu;
    protected State $backState;
    protected State $tryAgainState;

    public function __construct(array $errors, State $backState, State $tryAgainState) {
        $this->errors = $errors;
        $this->backState = $backState;
        $this->tryAgainState = $tryAgainState;
    }

    public function initialize() :void {
        $this->menu = new SelectMenu(
            [
                1 => new SelectMenuOption("Try again.", $this->tryAgainState),
                2 => new SelectMenuOption("Back.", $this->backState)
            ]
        );
    }

    public abstract function render(): void;
}