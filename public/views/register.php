<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/global.css">
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
    <title>Zarejestruj się</title>
</head>

<body>
    <div class="container">
        <div class="overlap-group">
            <div class="page-header"><div class="register-text">Register</div></div>
            <button type="button-signUp" onclick="window.location.href='login'"><div class="logIn">Login</div></button>
            <form class="register" action="register" method="POST">
                <input name="email" type="text" placeholder="email@email.com">
                <input name="name" type="text" placeholder="Name">
                <input name="surname" type="text" placeholder="Surname">
                <input name="password" type="password" placeholder="Password">
                <button type="registerButton">REGISTER</button>
            </form>
        </div>
    </div>
</body>