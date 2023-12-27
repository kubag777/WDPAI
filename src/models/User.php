<?php

class User {
    private $email;
    private $password;
    private $name;
    private $surname;
    private $id;

    public function __construct(
        string $email,
        string $password,
        string $name,
        string $surname,
        int $id = null
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->id = $id;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function getId(){
        return $this->id;
    }
}