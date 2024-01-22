<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../style/style-login.css">
</head>
<body>
<div class="container">
    <form action="addUser.php" method="post">
        <input class="input" type="text" name="username" placeholder="username" required autofocus><br>
        <input class="input" type="email" name="email" placeholder="name@example.com" required><br>
        <input class="input" type="password" name="pw" placeholder="password" required><br>
        <input class="button" type="submit" value="REGISTRATI">
    </form>
    <a class="ref" href="login.php">Login</a>
</div>
</body>
</html>