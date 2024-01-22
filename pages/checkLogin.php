<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Login Failed</title>
    <link rel="stylesheet" type="text/css" href="../style/style-login.css">
</head>
<body>
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
            if (isset($_COOKIE['page']))
                $page = $_COOKIE['page'];
            else $page = 'showRecipes.php';
            setcookie('page', null, time() + 86400, '/');
            header('Location:'.$page);
        }
        else {
            echo "<div class='container'>
                <p class='text'>CREDENZIALI ERRATE</p>
                <a class='ref' href='login.php'>Login</a>
                </div>
            ";
        }
    }
    ?>
</body>
</html>
