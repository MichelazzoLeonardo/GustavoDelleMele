<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Recipes</title>
    <link rel="stylesheet" type="text/css" href="../style/style-main.css">
    <?php
    if(!isset($_COOKIE['user'])) {
        setcookie('page', 'community.php', time() + 86400, '/');
        header('Location:login.php');
    }
    ?>
</head>
<body>
<div class="parent-header">
    <div class="header">
        <div class="div-logo">
            <img class="logo" src="../img/background/logo-minecraft.svg" alt="logo-minecraft.svg">
        </div>
        <br>
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
</div>


<div class="parent-container">

        <?php
        $FILE_PATH = '../data/farms.json';
        $JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);

        if (isset($_POST['remove']))
            foreach ($JSON_DATA as &$farm)
                if ($farm['name'] == $_POST['remove'])
                    unset($JSON_DATA[array_search($farm, $JSON_DATA)]);
        file_put_contents($FILE_PATH, json_encode($JSON_DATA, JSON_PRETTY_PRINT));
        $JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);

        if (!empty($JSON_DATA)) {
            foreach ($JSON_DATA as $farm) {
                echo "
                    <div class='container'>
                    <h3 class='title'>" . $farm['name'] . "</h3>
                    <div class='sub-div'>
                    <h5 class='subtitle'>by " . $farm['owner'] . "</h5>
                    <p class='text'><b>Ingredienti:</b><br>" . $farm['ingredients'] . "</p>
                    </div>
                    <div class='norm'>
                    <p class='text'><b>Preparazione:</b><br>" . $farm['preparation'] . "</p>";
                if ($_COOKIE['user'] == $farm['owner'])
                    echo "
                    <div class='div-buttons'>
                    <form action='newFarm.php' method='post'>
                        <input type='hidden' name='edit' value='" . $farm['name'] . "'>
                        <input type='submit' class='div-button edit' value='✏️'>
                    </form>
                    <form action='community.php' method='post'>
                        <input type='hidden' name='remove' value='" . $farm['name'] . "'>
                        <input type='submit' class='div-button remove' value='🗑️'>
                    </form>
                    </div>";
                echo "
                    </div>
                    </div>
        ";
            }
        } else {
            echo "<h3 class='title'>Wow, such empty</h3>";
        }
        ?>
</div>
</body>
</html>
