<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/global.css">
    <link rel="stylesheet" type="text/css" href="public/css/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/lists.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <!-- Użyć w każdym pliku po zalogowaniu -->
    <header>
        <ul>
            <li><a class="active" href="profile">Profil</a></li>
            <li><a href="friends">Znajomi</a></li>
            <li><a href="lists">Twoje Listy</a></li>
            <li style="float:right"><a href="#" onclick="window.location.href='logout'">Wyloguj się</a></li>
        </ul>
    </header>
    
    <div class="mainFrame">
        <div class="headerClass">
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
                        echo '<div class = "oneList" onclick="window.location.href=\'listView#'.$value->getListID().'\'">';
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
