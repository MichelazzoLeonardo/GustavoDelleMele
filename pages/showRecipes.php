<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Recipes</title>
    <link href="../style/style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <?php
    $FILE_PATH = '../data/recipes.json';
    $JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);

    if (!empty($JSON_DATA)) {
        foreach ($JSON_DATA as $recipe) {
            echo "
        <h3>" . $recipe['name'] . "</h3>
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
</form><br><br>
<form action="login.php" method="post">
    <input type="submit" value="<<<">
</form>
</body>
</html>