<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Recipes</title>
    <link rel="stylesheet" type="text/css" href="../style/style-main.css">
    <?php
    if(!isset($_COOKIE['user'])) {
        setcookie('page', 'showRecipes.php', time() + 86400, '/');
        header('Location:login.php');
    }
    function remove() {

    }
    ?>
</head>
<body>
<div class="parent-container">

        <?php
        $FILE_PATH = '../data/recipes.json';
        $JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);

        if (!empty($JSON_DATA)) {
            foreach ($JSON_DATA as $recipe) {
                echo "<div class='container'>
        <h3 class='title'>" . $recipe['name'] . "</h3>
        <div class='sub-div'>
        <h5 class='subtitle'>by ".$recipe['owner']."</h5>
        <p class='text'><b>Ingredienti:</b><br>" . $recipe['ingredients'] . "</p>
        </div>
        <div class='norm'>
        <p class='text'><b>Preparazione:</b><br>" . $recipe['preparation'] . "</p>
        </div>
        <form action='newRecipe.php' method='post'>
            <input type='hidden' name='edit' value='si'>
            <input type='submit' class='edit' value='✏️'>
        </form>
        
        <button class='remove' onclick=''>🗑️</button>
        </div>
        ";
            }
        } else {
            echo "<p class='text'>NESSUNA RICETTA INSERITA AL MOMENTO</p>";
        }
        ?>
</div>

</body>
</html>
<!--
{
        "name": "Spaghetti",
        "ingredients": "pasta",
        "preparation": "\u00e8 easy dai",
        "owner": "polo"
    },
    {
        "name": "Pasta al sugo",
        "ingredients": "Pasta e sugo",
        "preparation": "Prendi la pasta e metti il sugo",
        "owner": "leonardo"
    },
    {
        "name": "Pasta al pesto",
        "ingredients": "Pasta, pesto",
        "preparation": "Fai la pasta, aggiungi il pesto",
        "owner": "leonardo"
    }
-->