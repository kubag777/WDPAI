<?php 

require_once 'AppController.php';
class DefaultController extends AppController{
    function lists(){  
        $this->render('lists');
    }
    function friends(){  
        $this->render('friends');
    }
    function profile(){  
        $this->render('profile');
    }
    function listView(){  
        $this->render('listView');
    }
}