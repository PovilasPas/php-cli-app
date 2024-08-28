<?php

class ProgressIndicator {
    private float $maxVal;
    private bool $hasBeenRendered;

    public function __construct(float $maxVal) {
        $this->maxVal = $maxVal;
        $this->hasBeenRendered = false;
    }

    public function render(float $curVal) :void {
        if($this->hasBeenRendered) {
            echo "\033[F";
            echo "\033[K";
            $this->hasBeenRendered = false;
        }
        echo "Progress: " . number_format($curVal/$this->maxVal * 100, 2) . "%" . PHP_EOL;
        $this->hasBeenRendered = true;
    }
}