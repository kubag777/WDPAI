<head>
    <link rel="stylesheet" type="text/css" href="/public/css/listView.css">
</head>

<?php
    if (isset($_GET['id'])) {
        require_once __DIR__.'/../../src/repository/ListsRepository.php';
        $paramValue = $_GET['id'];
        $listsRepo = new ListsRepository(); 
        $fields = $listsRepo->getMyFields($paramValue);
        echo '<div class="grid-container">';
        foreach ($fields as $field) {
        // dodać znaczek zaznaczenia 
            if($field->getState() == 1){
                echo '<div class = "oneList" onclick="changeFieldState('.$field->getFieldId().')"><a>'.$field->getName().'</a><img src="/public/img/check-icon.png" style = "width: 50px;"></div>';
            } else {
                echo '<div class = "oneList" onclick="changeFieldState('.$field->getFieldId().')"><a>'.$field->getName().'</a><img src="/public/img/x-icon.png" style = "width: 50px;"></div>';
            }
        }
        echo '</div>';
    }

?>

<script>
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
</script>