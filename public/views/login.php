<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/global.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="container">
        <div class="overlap-group">
            <div class="page-header"><div class="login-text">Log In</div></div>
            <div class="button-signUp"><div class="SignUp">Sign Up</div></div>
            <form class="login" action="login" method="POST">
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
                <input name="pass" type="password" placeholder="password">
                <button type="loginButton">LOGIN</button>
            </form>
        </div>
        <div class="forgot"><a href="">Forgot your password?</a></div>
    </div>
</body>