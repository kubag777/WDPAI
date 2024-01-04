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
            $myField->setFieldId($fieldArray['field_id']);
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
    }

    public function changeFieldState(int $field_id):void{
        $stmt = $this->database->connect()->prepare('
            UPDATE fields
            SET is_checked = not (SELECT is_checked FROM fields where field_id = :field_id)
            WHERE field_id = :field_id
        ');
        $stmt->bindParam(':field_id', $field_id, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function addNewList(string $name, int $owner_id, int $friend_id): void {
        $stmt = $this->database->connect()->prepare('
        INSERT INTO lists (list_name, owner_user_id)
        VALUES (:name, :owner_id);
        ');
        $stmt->bindParam(':owner_id', $owner_id, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        $stmtListID = $this->database->connect()->prepare('
        SELECT MAX(list_id) as list_id FROM lists;
        ');
        $stmtListID->execute();
        $queryResult = $stmtListID->fetch();
        $list_id = $queryResult['list_id'];
        $this->debug($list_id);
        //foreach ($friends_ids as $user_id) {
            //if(is_integer($friends_ids)){
                $stmt2 = $this->database->connect()->prepare('
                INSERT INTO users_lists (user_id, list_id)
                    VALUES (:user_id, :list_id);
                ');
                $stmt2->bindParam(':user_id', $friend_id, PDO::PARAM_STR);
                $stmt2->bindParam(':list_id', $list_id, PDO::PARAM_STR);
                $stmt2->execute();
                //}
                //}
        $stmt2->bindParam(':user_id', $owner_id, PDO::PARAM_STR);
        $stmt2->execute();
    }

    public function getOwner(int $list_id): int{
        $stmt = $this->database->connect()->prepare('
            SELECT owner_user_id
            FROM lists
            WHERE list_id = :list_id;
        ');
        $stmt->bindParam(':list_id', $list_id, PDO::PARAM_STR);
        $stmt->execute();
        $queryResult = $stmt->fetch();
        return $queryResult['owner_user_id'];
    }

    public function deleteList(int $list_id): void{
        $stmt  = $this->database->connect()->prepare('
        DELETE FROM fields WHERE list_id = :list_id;
        ');
        $stmt->bindParam(':list_id', $list_id, PDO::PARAM_STR);
        $stmt->execute();

        $stmt = $this->database->connect()->prepare('
        DELETE FROM users_lists WHERE list_id = :list_id;
        ');
        $stmt->bindParam(':list_id', $list_id, PDO::PARAM_STR);
        $stmt->execute();

        $stmt = $this->database->connect()->prepare('
        DELETE FROM lists WHERE list_id = :list_id;
        ');
        $stmt->bindParam(':list_id', $list_id, PDO::PARAM_STR);
        $stmt->execute();
    }
}