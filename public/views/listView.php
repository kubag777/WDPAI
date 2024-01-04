<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="/public/css/global.css">
    <link rel="stylesheet" type="text/css" href="/public/css/menu.css">
    <link rel="stylesheet" type="text/css" href="/public/css/listView.css">

    <title>Lista</title>
    <script>
        function deleteListButton(e) {
            document.querySelector('button.deleteList').classList.add('visible');
        }
    </script>

</head>

<body>
    <header>
        <ul>
            <li><a href="/profile">Profil</a></li>
            <li><a href="/friends">Znajomi</a></li>
            <li><a href="/lists">Twoje Listy</a></li>
            <li style="float:right"><a href="#" onclick="window.location.href='/logout'">Wyloguj się</a></li>
        </ul>
    </header>

    <div class="mainFrame">
        <div class="header">
            <button class = "deleteList" type="button" onclick="deleteList()">Usuń listę</button>
            <?php
                require_once __DIR__. '/../../src/controllers/SessionController.php';
                require_once __DIR__. '/../../src/repository/ListsRepository.php';
                
                if (isset($_GET['id'])) {
                    $list_id = $_GET['id'];
                    $listsRepo = new ListsRepository(); 
                    $owner_id = $listsRepo->getOwner($list_id);
                    $session = new SessionController();
                    $user_id = $session->getUserId();
                    if($user_id == $owner_id){
                        echo "<script>";
                        echo "deleteListButton();";
                        echo "</script>";
                    }
                }
            ?>
            <span>Nazwa listy</span>
            <button class = "addFieldButton" type="button" onclick="addNewFieldWnd()"><div class="addNew">+</div></button>
        </div>
        <div class = "fields">
            <?php
                echo '<iframe id="grid-iframe" src="/listElems/?id='.$_GET['id'].'" ></iframe>';
            ?>
            
        </div>
    </div>
    <div class="newFieldWnd">
        <form method="post" class="addNewField">
            <input type="fieldName" name="fieldName" placeholder="Nazwa pola">
            <input type="submit" value="Dodaj">
        </form>
    </div>
</body>

<script>
    function addNewFieldWnd(e) {
        document.querySelector('.newFieldWnd').classList.toggle('visible');
    }

    function deleteListButton(e) {
        document.querySelector('button.deleteList').classList.add('visible');
    }

    function changeFieldState(field_id){
        let data = new FormData();
        data.append('field_id', field_id);
        postData("/changeFieldState", data);
    }

    function postData(url = '', data = {}) {
    // Opcje żądania
        const options = {
            method: 'POST',     // Metoda HTTP
            body: data,           // Dane do wysyłania
        };

        // Wykonanie żądania fetch z podanym adresem URL i opcjami
        return fetch(url, options)
            .then(response => {
                console.log[response.status];
                location.reload();
                return response.text();
                })
            .catch(error => console.error('Error:', error)); // Obsługa błędów
    }

    document.querySelector('.addNewField').addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData(e.target);
        data.append('list_id', <?php echo $_GET['id'];?>);
        postData("/addNewField", data);
    });

    function odswiezIframe() {
        var iframe = document.getElementById('grid-iframe');
        iframe.src = iframe.src;
        // Uruchom ponownie funkcję co 5 sekund (5000 ms)
        setTimeout(odswiezIframe, 10000);
    }

    window.onload = function () {
        odswiezIframe();
    };

    function deleteList() {
        window.location.href = '/profile';
        let data = new FormData();
        data.append('list_id', <?php echo $_GET['id'];?>);
        postData("/deleteList", data);
    }


</script>