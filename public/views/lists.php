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
            <button type="button" onclick="addNewListWnd()"><div class="addNew">+</div></button>
        </div>
        <!-- Dodać php z wczytywaniem list z bazy i wyswietlaniem zamiast tych elementów -->
        <div class = "lists">
            <?php
                require_once __DIR__.'/../../src/repository/ListsRepository.php';
                require_once __DIR__.'/../../src/controllers/SessionController.php';
                $session = new SessionController();
                if(!$session->checkSession()) {
                    echo "Brak sesji";
                    
                    // przekieruj do login.php
                } else {
                    $listsRepo = new ListsRepository();
                    $userLists = $listsRepo->getUserLists($session->getUserId());
                    foreach ($userLists as $list => $value) {
                        echo '<div class = "oneList" onclick="window.location.href=\'listView/?id='.$value->getListID().'\'">';
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

    <div class="newListWnd">
        <form method="post" class="addNewList">
            <input type="listName" name="listName" placeholder="Nazwa Listy">
            <input type="friend" name="friend" placeholder="ID znajomego">
            <input type="submit" value="Dodaj">
        </form>
    </div>
</body>

<script>
    function addNewListWnd() {
        document.querySelector('.newListWnd').classList.toggle('visible');
    }

    function postData(url = '', data = {}) {
    // Opcje żądania
        const options = {
            method: 'POST',     // Metoda HTTP
            body: data
        };

        // Wykonanie żądania fetch z podanym adresem URL i opcjami
        return fetch(url, options)
            .then(response => {
                console.log[response.status];

                location.reload();
                })
            .catch(error => console.error('Error:', error)); // Obsługa błędów
    }

    document.querySelector('.addNewList').addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData(e.target);
        data.append('user_id', 
            <?php 
                require_once __DIR__.'/../../src/controllers/SessionController.php';
                $session = new SessionController();
                echo $session->getUserId();
            ?>);
        postData("/addNewList", data);
    });

</script>
