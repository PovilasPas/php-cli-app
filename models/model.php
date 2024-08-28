<?php

abstract class Model {
    protected int $id;

    public function setId(int $id) :void {
        $this->id = $id;
    }

    public function getId() :int {
        return $this->id;
    }
}