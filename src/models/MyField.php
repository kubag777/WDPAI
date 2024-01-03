<?php

class MyField {
    private $name;
    private $isChecked;
    private $field_id;

    public function __construct(
        string $name,
        bool $isChecked = false
    ) {
        $this->name = $name;
        $this->isChecked = $isChecked;
    }

    public function getState() {
        return $this->isChecked;
    }
    public function changeState() {
        $this->isChecked = !($this->isChecked);
    }
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getFieldId() {
        return $this->field_id;
    }
    public function setFieldId($field_id) {
        $this->field_id = $field_id;
    }
}