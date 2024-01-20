<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Recipes</title>
    <link href="../style/style.css" type="text/css" rel="stylesheet">
    <?php
    if(!isset($_COOKIE['user'])) {
        setcookie('page', 'showRecipes.php', time() + 86400, '/');
        header('Location:login.php');
    }
    ?>
</head>
<body>
    <?php
    $FILE_PATH = '../data/recipes.json';
    $JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);

    if (!empty($JSON_DATA)) {
        foreach ($JSON_DATA as $recipe) {
            echo "
        <h3>" . $recipe['name'] . "</h3>
        <h5>by ".$recipe['owner']."</h5>
        <p>" . $recipe['ingredients'] . "</p>
        <p>" . $recipe['preparation'] . "</p>
        ";
        }
    } else {
        echo "NESSUNA RICETTA INSERITA AL MOMENTO<br><br>";
    }
    ?>
    <form action="newRecipe.php" method="post">
        <input type="submit" value="+">
    </form><br>
    <form action="logout.php" method="post">
        <input type="submit" value="LOGOUT">
    </form><br><br>
    <form action="login.php" method="post">
        <input type="submit" value="<<<">
    </form>
</body>
</html>