<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Add Recipe</title>
    <link rel="stylesheet" type="text/css" href="../style/style-main.css">
    <?php
    if(!isset($_COOKIE['user'])) {
        setcookie('page', 'newFarm.php', time() + 86400, '/');
        header('Location:login.php');
    }
    ?>
</head>
<body>
<div class="header">
    <a class='header-button' href='community.php'>HOME</a>
    <?php
    if ($_COOKIE['user'] != 'guest') {
        echo "<a class='header-button' href='myFarms.php'>" . $_COOKIE['user'] . "</a>";
        echo "<a class='header-button' href='logout.php'>LOGOUT</a>";
    }
    if ($_COOKIE['user'] == 'guest')
        echo "<a class='header-button' href='login.php'>LOGIN</a>";
    ?>

</div>

        <?php
        if($_COOKIE['user'] == 'guest') {
            echo "<h1 class='title'>Utente non riconosciuto</h1>";
            setcookie('page', 'newFarm.php', time() + 86400, '/');
        }
        else {
            if (isset($_POST['edit'])) {

                $recipes = json_decode(file_get_contents("../data/farms.json"), true);
                $recipe = null;
                foreach ($recipes as $r)
                    if ($r['name'] == $_POST['edit']) {
                        $recipe = $r;
                        break;
                    }
                echo "
                
                <form action='insertFarm.php' method='post'>
                    <input type='hidden' name='edit' value='" . $r['name'] . "'>
                    <input type='text' name='name' value='" . $r['name'] . "' required autofocus><br>
                    <textarea cols='30' rows='5' name='ingredients' required>" . $r['ingredients'] . "</textarea><br>
                    <textarea cols='30' rows='15' name='preparation' required>" . $r['preparation'] . "</textarea><br>
                    <input type='submit' value='OK'>
                </form>
            ";
            } else {
                echo "
                <form action='insertFarm.php' method='post'>
                    <input type='text' name='name' placeholder='Nome della ricetta' required autofocus><br>
                    <textarea cols='30' rows='5' name='ingredients' placeholder='Ingredienti' required></textarea><br>
                    <textarea cols='30' rows='15' name='preparation' placeholder='Preparazione' required></textarea><br>
                    <input type='submit' value='OK'>
                </form>
            ";
            }
        }
        ?>
</body>
</html>