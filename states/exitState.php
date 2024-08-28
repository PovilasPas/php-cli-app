<?php

class ExitState extends State {
    public function initialize(): void {

    }

    public function render(): void {
        exit;
    }
}