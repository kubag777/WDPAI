<?php

require_once __DIR__.'/../../Database.php';

class Repository {
    protected $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    function debug($message) {
        file_put_contents('php://stderr', print_r($message, TRUE), FILE_APPEND);
    }
}