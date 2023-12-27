<?php

require_once 'AppController.php';
require_once __DIR__ . '/SessionController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController {

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        
        $user = $this->userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if (!password_verify($_POST['password'], $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $session = new SessionController();
        $session->startSession($user->getId());

        // gdzie przenieść po logowaniu
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/lists");
    }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
       // $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        // if ($password !== $confirmedPassword) {
        //     return $this->render('register', ['messages' => ['Please provide proper password']]);
        // }

        //TODO try to use better hash function
        $user = new User($email, password_hash($password, PASSWORD_DEFAULT), $name, $surname);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }
}