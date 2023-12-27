<?php
require_once 'AppController.php';
session_start();


  class SessionController extends AppController
    {
        public function startSession(int $user_id){
            $_SESSION['user_id'] = $user_id;
        }
        public function checkSession(): bool{
            return isset($_SESSION['user_id']);
        }
        public function logout(){
            session_destroy();
        }
        public function getUserId(): int{
            return $_SESSION['user_id'];
        }
    }
?>