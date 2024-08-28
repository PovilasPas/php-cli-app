<?php

abstract class State {
    protected StateManager $context;
    public abstract function initialize() :void;
    public abstract function render() :void;
    public function setContext(StateManager $manager) :void {
        $this->context = $manager;
    }
}