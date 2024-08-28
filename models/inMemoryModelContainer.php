<?php

class InMemoryModelContainer implements IModelContainer {
    private array $models;
    private int $runningId;

    public function __construct() {
        $this->models = [];
        $this->runningId = 0;
    }

    public function getModels(): array {
        return array_map(fn($item) => clone $item, $this->models);
    }

    public function getModel(int $id): ?Model {
        if(array_key_exists($id, $this->models)) {
            return $this->models[$id];
        } 
        return null;
    }

    public function addModel(Model $model) :void {
        $id = $this->runningId++;
        $model->setId($id);
        $this->models[$id] = $model;
    }

    public function changeModel(int $id, Model $model) :bool {
        if(array_key_exists($id, $this->models)) {
            $model->setId($id);
            $this->models[$id] = $model;
            return true;
        }
        return false;
    }

    public function deleteModel(int $id): bool {
        if(array_key_exists($id, $this->models)) {
            unset($this->models[$id]);
            return true;
        }
        return false;
    }

    public function containsModel(int $id): bool {
        return array_key_exists($id, $this->models);
    }
}