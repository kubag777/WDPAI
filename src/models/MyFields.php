<?php

class MyFields {
    private $name;
    private $isChecked;

    public function __construct(
        string $name
    ) {
        $this->name = $name;
        $this->isChecked = false;
    }

    public function getState() {
        return $this->isChecked;
    }
    public function changeState() {
        $this->isChecked = !($this->isChecked);
    }
}