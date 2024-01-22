<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Registration Failed</title>
    <link rel="stylesheet" type="text/css" href="../style/style-login.css">
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $FILE_PATH = '../data/users.json';
    $USERS = json_decode(file_get_contents($FILE_PATH), true);
    $user = array(
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => $_POST['pw']
    );
    $exists = false;
    if (!empty($USERS)) {
        foreach ($USERS as $USER) {
            if ($USER['username'] == $user['username'] || $USER['email'] == $user['email']) {
                $exists = true;
                break;
            }
        }
    }
    if(!$exists) {
        $USERS[] = $user;
        file_put_contents($FILE_PATH, json_encode($USERS, JSON_PRETTY_PRINT));
        header('Location:login.php');
    }
    else {
        echo "<div class='container'>
            <p class='text'>USERNAME O EMAIL GIA' REGISTRATO</p>
            <a class='ref' href='register.php'>Registrati</a>
            </div>
        ";
    }
}
?>
</body>
</html>
