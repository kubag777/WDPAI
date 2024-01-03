<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="/public/css/global.css">
    <link rel="stylesheet" type="text/css" href="/public/css/menu.css">
    <link rel="stylesheet" type="text/css" href="/public/css/listView.css">

    <title>Lista</title>
</head>

<body>
    <header>
        <ul>
            <li><a class="active" href="/profile">Profil</a></li>
            <li><a href="/friends">Znajomi</a></li>
            <li><a href="/lists">Twoje Listy</a></li>
            <li style="float:right"><a href="#" onclick="window.location.href='logout'">Wyloguj się</a></li>
        </ul>
    </header>

    <div class="mainFrame">
        <div class="header">
            <span>Nazwa listy</span>
            <button type="button" onclick="addNewFieldWnd()"><div class="addNew">+</div></button>
        </div>
        <div class = "fields">
            <?php
                if (isset($_GET['id'])) {
                    require_once __DIR__.'/../../src/repository/ListsRepository.php';
                    $paramValue = $_GET['id'];
                    $listsRepo = new ListsRepository(); 
                    $fields = $listsRepo->getMyFields($paramValue);
                    foreach ($fields as $field) {
                    // dodać znaczek zaznaczenia 
                    if($field->getState() == 1){
                        echo '<div class = "oneList" onclick="changeFieldState('.$field->getFieldId().')"><a>'.$field->getName().'</a><img src="/public/img/check-icon.png" style = "width: 50px;"></div>';
                    } else {
                        echo '<div class = "oneList" onclick="changeFieldState('.$field->getFieldId().')"><a>'.$field->getName().'</a><img src="/public/img/x-icon.png" style = "width: 50px;"></div>';
                    }
                }
            }
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
    
// POLIGON TESTOWY

    function refreshTable(){
        fetch(location)
        .then(response => {location.reload();})
        .then(data => {
            document.getElementById('tableHolder').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
        setTimeout(refreshTable, 5000 );
    }

    setTimeout(refreshTable, 5000 );





</script>