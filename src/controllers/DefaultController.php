<?php 

require_once 'AppController.php';
class DefaultController extends AppController{
    function login(){
        include __DIR__.'/../views/login.html';
    }

    function dashboard(){  
        include __DIR__.'/../views/dashboard.html';
    }
}