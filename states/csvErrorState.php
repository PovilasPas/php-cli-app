<?php

class CsvErrorState extends ErrorState {
    public function render() :void {
        foreach($this->errors as $line => $modelErrors) {
            echo "Line " . $line . ":" . PHP_EOL;
            foreach($modelErrors as $fieldErrors) {
                foreach($fieldErrors as $error) {
                    echo '*' . $error . PHP_EOL;
                }
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
        $selected = $this->menu->getSelection();
        $this->context->changeState($selected);
    }
}