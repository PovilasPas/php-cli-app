<?php

class SelectMenuOption {
    private string $name;
    private State $action;

    public function __construct(string $name, State $action) {
        $this->name = $name;
        $this->action = $action;
    }

    public function getName() :string {
        return $this->name;
    }

    public function getAction() :State {
        return $this->action;
    }
}