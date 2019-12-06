<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="login-form/login-form.css">
    <link rel="preload" href="img/login-form-background.webp" as="image" type="image/webp"  >
    <title>Login</title>
</head>
<body class="body">
    <form class="login-form" action="login.php" method="post">
        <h1 class="login-form__title-text">Login</h1>
        <input class="input login-form__input" type="text" name="login_field" placeholder="Username" style="background:#0a0e31;" required>
        <input class="input login-form__input" type="password" name="password_field" placeholder="Password" style="background:#0a0e31;" required>
        <input class="button login-form__button" type="submit" name="login_button" value="Login">
    </form>
</body>
</html>