<?php

class MyField {
    private $name;
    private $isChecked;

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
}