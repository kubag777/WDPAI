<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/MyList.php';
require_once __DIR__.'/../models/MyField.php';



class ListsRepository extends Repository
{
    public function getUserLists(int $user_id): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM lists
            JOIN users_lists ON lists.list_id = users_lists.list_id
            WHERE users_lists.user_id = :user_id;
        ');
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();

        $listsToReturn = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $listArray) {
            $stmtUsers = $this->database->connect()->prepare('
                SELECT user_id 
                FROM users_lists 
                WHERE list_id = :list_id;
            ');
            $stmtUsers->bindParam(':list_id', $listArray['list_id'], PDO::PARAM_INT);
            $stmtUsers->execute();
    
            $usersArray = [];
            foreach ($stmtUsers->fetchAll(PDO::FETCH_ASSOC) as $user) {
                $usersArray[] = $user['user_id'];
            }
    
            $myList = new MyList($listArray['list_name'], $usersArray, $listArray['list_id']);
            $listsToReturn[] = $myList;
        }
        return $listsToReturn;
    }

    public function getMyFields(int $list_id): array{
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM fields
            WHERE fields.list_id = :list_id;
        ');
        $stmt->bindParam(':list_id', $list_id, PDO::PARAM_STR);
        $stmt->execute();
        $fieldsToReturn = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $fieldArray) {
            $myField = new MyField($fieldArray['name'], $fieldArray['is_checked']);
            $fieldsToReturn[] = $myField;
        }
        return $fieldsToReturn;
    }

    public function addNewField(string $name, int $list_id): void {
        $stmt = $this->database->connect()->prepare('
        INSERT INTO fields (name, is_checked, list_id)
            VALUES (:name, false, :list_id);
        ');
        $stmt->bindParam(':list_id', $list_id, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return;
    }
}

// przenisc do kontrolera
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $repo = new ListsRepository;
    $repo->addNewField($_POST['fieldName'], $_POST['list_id']);
}