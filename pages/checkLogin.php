<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $FILE_PATH = '../data/users.json';
    $USERS = json_decode(file_get_contents($FILE_PATH), true);
    $user = array(
        'username' => $_POST['username'],
        'password' => $_POST['pw']
    );
    $check = false;
    if (!empty($USERS)) {
        foreach ($USERS as $USER) {
            if (($USER['username'] == $user['username'] || $USER['email'] == $user['username'])
                && $USER['password'] == $user['password']) {
                $check = true;
                break;
            }
        }
    }
    if ($check) {
        setcookie('user', $user['username'], time() + 86400, '/');
        header('Location:showRecipes.php');
    }
    else {
        echo "
            CREDENZIALI ERRATE<br>
            <a href='login.php'>Login</a>
        ";
    }
}