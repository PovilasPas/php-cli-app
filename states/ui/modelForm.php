<?php 

class ModelForm {
    private ModelCreator $creator;

    public function __construct(ModelCreator $creator) {
        $this->creator = $creator;
    }

    public function getModel(?Model $current = null) :Model|array {
        $fields = [];
        $fillables = $this->creator->getFillables($current);
        foreach($fillables as $key => $text) {
            $value = trim(readline($text));
            $fields[$key] = $value;
        }
        $value = $this->creator->createOrUpdate($fields, $current);
        return $value;
    }
}