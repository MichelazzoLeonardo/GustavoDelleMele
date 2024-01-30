<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../style/style-login.css">
</head>
<body>
<div class="parent-header">
    <div class="header">
        <div class="div-logo">
            <img class="logo" src="../img/background/logo-minecraft.svg" alt="logo-minecraft.svg">
        </div>
    </div>
</div>
<div class="container">
    <p class="title" >REGISTRATI</p>
    <div class="internal-div">
        <div class="sub-div">
            <form action="addUser.php" method="post">
                <input class="input" type="text" name="username" placeholder="username" required autofocus><br>
                <input class="input" type="email" name="email" placeholder="name@example.com" required><br>
                <input class="input" type="password" name="pw" placeholder="password" required><br>
                <input class="button" type="submit" value="REGISTRATI">
            </form>
        </div>
    </div>
</div>
<div class="refs-div">
    <a class="ref" href="login.php">Accedi</a>
</div>
</body>
</html>