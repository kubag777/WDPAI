<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/global.css">
    <link rel="stylesheet" type="text/css" href="public/css/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile.css">
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
        <div class="picture"> <img src ="/public/img/profile.jpg"></div>
        <div class="info">
            <!-- Wyciągnąć z bazy -->
            <?php
            ?>

            <h1>Imie Nazwisko</h1>
            <h2>Wiek</h2>
            <h3>Opis</h3>
        </div>
    <div>
</body>