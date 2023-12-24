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

    function register(){  
        $this->render('register');
       // include __DIR__.'/../views/dashboard.html';
    }
    function lists(){  
        $this->render('lists');
       // include __DIR__.'/../views/dashboard.html';
    }
    function friends(){  
        $this->render('friends');
       // include __DIR__.'/../views/dashboard.html';
    }
    function profile(){  
        $this->render('profile');
       // include __DIR__.'/../views/dashboard.html';
    }
}