<?php 

require_once 'AppController.php';
class DefaultController extends AppController{
    function login(){
        $this->render('login');
        //include __DIR__.'/../views/login.php';
    }

    function dashboard(){  
        $this->render('dashboard');
       // include __DIR__.'/../views/dashboard.html';
    }
}