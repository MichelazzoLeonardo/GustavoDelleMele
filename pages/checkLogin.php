<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Login Failed</title>
    <link rel="icon" href="../img/icon/creeper.png">
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
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        require 'classes/DB.php';

        $conn = DB::getConnection();

        $username = $_POST['username'];
        $password = $_POST['pw'];

        $query = "SELECT * FROM user WHERE username = '$username';";
        $user = $conn->query($query);
        $row = $user->fetch_assoc();

        if ($user->num_rows > 0 && password_verify($password, $row['password'])) {
            setcookie('user', $username, time() + 86400 * 7, '/');
            setcookie('orderby', 'ASC', time() + 86400 * 7, '/');
            if (isset($_COOKIE['page']))
                $page = $_COOKIE['page'];
            else $page = 'community.php';
            setcookie('page', null, time() + 86400, '/');
            header('Location:'.$page);
        }
        else {
            echo "<div class='container' style='width: 45%'>
                <p class='title' style='padding: 0'>CREDENZIALI ERRATE</p>
                <a class='ref' href='login.php'>Login</a>
                </div>
            ";
        }
    }
    ?>
</body>
</html>