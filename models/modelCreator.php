<?php 

abstract class ModelCreator {
    public final function createOrUpdate(array $fields, Model $current = null) :Model|array {
        if($current) {
            $fields = $this->mergeFields($fields, $current);
        }
        $validator = $this->getValidator();
        $fields = $validator->validate($fields);
        if($validator->isValid()) {
            return $this->createModel($fields);
        }
        return $validator->getErrors();
    }
    
    public abstract function getFillables(?Model $current = null) :array;

    protected abstract function mergeFields(array $fields, Model $model) :array;

    protected abstract function getValidator() :CompositeValidator;

    protected abstract function createModel(array $fields) :Model;

}