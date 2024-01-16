<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Login</title>
</head>
<body>
<form action="checkLogin.php" method="post">
    <input type="text" name="username" placeholder="username/email" required autofocus><br>
    <input type="password" name="pw" placeholder="password" required><br>
    <input type="submit" value="LOGIN">
</form>
<form action="guest.php" method="post">
    <input type="hidden" name="guest" value="true">
    <input type="submit" value="Accedi come ospite">
</form>
<a href="register.php">Registrati</a>
</body>
</html>