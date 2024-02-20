<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Registration Failed</title>
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
    $email = $_POST['email'];
    $password = password_hash($_POST['pw'], PASSWORD_DEFAULT);

    $query = "SELECT * FROM user WHERE username = '$username';";
    $users = $conn->query($query);

    if($users->num_rows == 0) {
        $insert = "INSERT INTO user(username, email, password) VALUE ('$username', '$email', '$password');";
        $conn->query($insert);
        header('Location:login.php');
    }
    else {
        echo "<div class='container'>
            <p class='title'>USERNAME GIA' REGISTRATO</p>
            <a class='ref' href='register.php'>Registrati</a>
            </div>
        ";
    }
}
?>
</body>
</html>
