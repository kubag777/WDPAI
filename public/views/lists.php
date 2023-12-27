<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/global.css">
    <link rel="stylesheet" type="text/css" href="public/css/lists.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="mainFrame">
        <div class="header">
            <span>Twoje listy</span>
            <button type="button-signUp" onclick="window.location.href='register'"><div class="addNew">+</div></button>
        </div>
        <!-- Dodać php z wczytywaniem list z bazy i wyswietlaniem zamiast tych elementów -->
        <div class = "lists">
            <?php
                require_once __DIR__.'/../../src/repository/ListsRepository.php';
                $session = new SessionController();
                if(!$session->checkSession()) {
                    echo "Brak sesji";
                    // przekieruj do login.php
                } else {
                    $listsRepo = new ListsRepository();
                    $userLists = $listsRepo->getUserLists($session->getUserId());
                    foreach ($userLists as $list => $value) {
                        echo '<div class = "oneList">';
                        echo '<div class="listIcon"></div>';
                        echo '<div class="listData">';
                        echo '    <div class="nazwa">'. $value->getName() .'</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            ?>
           
        </div>
    </div>
</body>