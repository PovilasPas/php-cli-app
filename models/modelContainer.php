<?php

interface IModelContainer {
    public function getModels() :array;
    public function getModel(int $id) :?Model;
    public function addModel(Model $model) :void;
    public function changeModel(int $id, Model $model) :bool;
    public function deleteModel(int $id) :bool;
    public function containsModel(int $id) :bool;
}