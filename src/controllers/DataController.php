<?php 

require_once 'AppController.php';
require_once __DIR__.'/../repository/ListsRepository.php';
class DataController extends AppController{

    function addNewField(){  
        error_log("Received data: " . print_r($_POST, true));
        if ($this->isPost()) {
            $listRepo = new ListsRepository();
            $listRepo->addNewField($_POST['fieldName'], $_POST['list_id']);
        }
    }

    function addNewList(){  
        if ($this->isPost()) {
            $listRepo = new ListsRepository();
            $listRepo->debug($_POST);
            $listRepo->addNewList($_POST['listName'], $_POST['user_id'], $_POST['friend']);
        }
    }

    function changeFieldState(){  
        if ($this->isPost()) {
            $listRepo = new ListsRepository();
            $listRepo->changeFieldState($_POST['field_id']);
        }
    }

    function deleteList(){  
        if ($this->isPost()) {
            $listRepo = new ListsRepository();
            $listRepo->deleteList($_POST['list_id']);
        }
    }

}