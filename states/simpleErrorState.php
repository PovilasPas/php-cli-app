<?php

class SimpleErrorState extends ErrorState {

    public function render(): void {
        foreach($this->errors as $fieldErrors) {
            foreach($fieldErrors as $error) {
                echo "*" . $error . PHP_EOL;
            }
        }
        echo PHP_EOL;
        $selected = $this->menu->getSelection();
        $this->context->changeState($selected);
    }


}