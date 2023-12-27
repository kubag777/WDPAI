<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/MyList.php';

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
}