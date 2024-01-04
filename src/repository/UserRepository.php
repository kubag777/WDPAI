<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users 
                LEFT JOIN users_info ON users.user_id = users_info.user_id
                WHERE users.email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }
        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['user_id']
        );
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password)
            VALUES (?, ?)
        ');
        $stmt->execute([
            $user->getEmail(),
            $user->getPassword()
        ]);

        $stmt = $this->database->connect()->prepare('
            SELECT MAX(user_id) as user_id FROM users
        ');
        $stmt->execute();
        $user_id = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_info (user_id, name, surname)
            VALUES (?, ?, ?)
        ');
        $stmt->execute([
            $user_id['user_id'],
            $user->getName(),
            $user->getSurname()
        ]);
    }
}