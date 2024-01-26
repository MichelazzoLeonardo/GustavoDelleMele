<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../style/style-login.css">
</head>
<body>
<div class="container">
    <form action="checkLogin.php" method="post">
        <input class="input" type="text" name="username" placeholder="username/email" required autofocus><br>
        <input class="input" type="password" name="pw" placeholder="password" required><br><br>
        <input class="button" type="submit" value="LOGIN">
    </form>
    <form action="guest.php" method="post">
        <input class="button" type="submit" value="Accedi come ospite">
    </form><br>
<a class="ref" href="register.php">Registrati</a>
</div>
</body>
</html>