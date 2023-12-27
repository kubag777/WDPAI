<?php

require_once __DIR__."/src/controllers/DefaultController.php";

$path = $_SERVER["REQUEST_URI"];
$path = trim($path, "/");

$actions = explode("/", $path);

$routes = [
    "" => "DefaultController",
    "login" => "DefaultController",
    "dashboard" => "DefaultController",
    "register" => "DefaultController",
    "lists" => "DefaultController",
    "friends" => "DefaultController",
    "profile" => "DefaultController"
];


if(!array_key_exists($actions[0], $routes)) {
    die("404 not found");
}

$controller = new $routes[$actions[0]]();

$action = $actions[0];
$controller->$action();