<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');

Router::get('lists', 'DefaultController');
Router::get('friends', 'DefaultController');
Router::get('profile', 'DefaultController');
Router::get('listView', 'DefaultController');

Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');

Router::get('logout', 'SessionController');

// dodać kontroler do obsługi dopdawania pol i list
Router::post('addNewField', 'DataController');
Router::post('addNewList', 'DataController');
Router::post('changeFieldState', 'DataController');

Router::run($path);
?>