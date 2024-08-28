<?php

class Table {
    private array $headers;
    private array $data;
    private array $pad;
    private string $noData;
    private array $lengths;
    private int $totalLength;

    public function __construct(array $headers, array $data, array $pad, string $noData) {
        $this->headers = $headers;
        $this->data = $data;
        $this->pad = $pad;
        $this->noData = $noData;
        $this->calculateTableParameters();
    }

    public function render() :void {
        echo str_repeat("-", $this->totalLength) . PHP_EOL;
        foreach($this->headers as $index => $header) {
            echo "|" . Utils::padString($header, $this->lengths[$index], " ", $this->pad[$index]);
        }
        echo "|" . PHP_EOL;
        echo str_repeat("-", $this->totalLength) . PHP_EOL;
        foreach($this->data as $row) {
            foreach($row as $index => $value) {
                echo "|" . Utils::padString($value, $this->lengths[$index], " ", $this->pad[$index]);
            }
            echo "|" . PHP_EOL;
        }
        if(!count($this->data)) {
            echo "|" . Utils::padString(mb_substr($this->noData, 0, $this->totalLength - 2, "UTF-8"), $this->totalLength - 2, " ", STR_PAD_BOTH) . "|" . PHP_EOL;
        }
        echo str_repeat("-", $this->totalLength) .PHP_EOL;
    }

    private function calculateTableParameters() :void {
        $this->lengths = [];
        foreach($this->headers as $header) {
            array_push($this->lengths, mb_strlen($header, "UTF-8"));
        }
        foreach($this->data as $row) {
            foreach($row as $index => $value) {
                $length = mb_strlen($value, "UTF-8");
                if($this->lengths[$index] < $length) {
                    $this->lengths[$index] = $length;
                }
            }
        }
        $this->totalLength = array_reduce($this->lengths, fn(int $sum, int $val) => $sum + $val, 0) + count($this->lengths) + 1;
    }
}