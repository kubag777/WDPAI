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
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="input-text" type="text" placeholder="email@email.com">
                <input name="input-text" type="text" placeholder="email@email.com">
                <input name="pass" type="password" placeholder="password">
                <button type="registerButton">REGISTER</button>
            </form>
        </div>
    </div>
</body>