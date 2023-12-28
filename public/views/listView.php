<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="/public/css/global.css">
    <link rel="stylesheet" type="text/css" href="/public/css/listView.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="mainFrame">
        <div class="header">
            <span>Nazwa listy</span>
            <button type="button-signUp" onclick="addNewFieldWnd()"><div class="addNew">+</div></button>
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
                        echo '<div class = "oneList"><a>'.$field->getName().'</a><img src="/public/img/check-icon.png" style = "width: 50px;"></div>';
                    } else {
                        echo '<div class = "oneList"><a>'.$field->getName().'</a><img src="/public/img/x-icon.png" style = "width: 50px;"></div>';
                    }

                    }
                }
            ?>
        </div>
    </div>
    <div class="newFieldWnd">
        <form method="post" class="addNewForm">
            <input type="fieldName" name="fieldName" placeholder="Nazwa pola">
            <input type="submit" value="Dodaj">
        </form>
    </div>
</body>



<script>
    function addNewFieldWnd(e) {
        document.querySelector('.newFieldWnd').classList.toggle('visible');
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

    document.querySelector('.addNewForm').addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData(e.target);
        data.append('list_id', <?php echo $_GET['id'];?>);
        postData("/src/repository/ListsRepository.php", data);
    });

</script>