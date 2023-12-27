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
            <button type="button-signUp" onclick="window.location.href='register'"><div class="SignUp">Sign Up</div></button>
            <form class="login" action="login" method="POST">
                <input name="email" type="text" placeholder="email@email.com">
                <input name="password" type="password" placeholder="password">
                <button type="loginButton">LOGIN</button>
            </form>
        </div>
        <div class="forgot"><a href="">Forgot your password?</a></div>
    </div>
</body>