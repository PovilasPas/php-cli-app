<?php

class SelectMenu {
    private array $actions;

    public function __construct(array $actions) {
        $this->actions = $actions;
    }

    public function getSelection() :State {
        $selected = $this->renderMenu();
        while(!array_key_exists($selected, $this->actions)) {
            $this->clearMenu(1);
            $selected = $this->renderMenu();
        }
        return $this->actions[$selected]->getAction();
    }

    private function renderMenu() :string {
        foreach($this->actions as $index => $action) {
            echo $index . ". " . $action->getName() . PHP_EOL;
        }
        $selected = trim(readline("Choose an option: "));
        return $selected;
    }

    private function clearMenu(int $extraLines = 0) :void {
        for($i = 0; $i < count($this->actions) + $extraLines; $i++) {
            echo "\033[F\033[K";
        }
    }
}