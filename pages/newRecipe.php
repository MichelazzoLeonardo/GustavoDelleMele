<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Add Recipe</title>
    <?php
    if(!isset($_COOKIE['user'])) {
        setcookie('page', 'newRecipe.php', time() + 86400, '/');
        header('Location:login.php');
    }
    elseif($_COOKIE['user'] == 'guest')
        echo "utente non riconosciuto<br>
        <form action='showRecipes.php' method='post'>
            <input type='submit' value='<<<'>
        </form>
        ";
    ?>
</head>
<body>
    <form action='addRecipe.php' method='post'>
        <?php
        if(isset($_POST['edit'])) {

            $recipes = json_decode(file_get_contents("../data/recipes.json"), true);
            $recipe = null;
            foreach ($recipes as $r)
                if ($r['name'] == $_POST['edit']) {
                    $recipe = $r;
                    break;
                }
                    echo "
            <input type='hidden' name='edit' value='" . $r['name'] . "'>
            <input type='text' name='name' value='".$r['name']."' required autofocus><br>
            <textarea cols='30' rows='5' name='ingredients' required>".$r['ingredients']."</textarea><br>
            <textarea cols='30' rows='15' name='preparation' required>".$r['preparation']."</textarea><br>
            <input type='submit' value='OK'>
            ";
        } else {
            echo "
            <input type='text' name='name' placeholder='Nome della ricetta' required autofocus><br>
            <textarea cols='30' rows='5' name='ingredients' placeholder='Ingredienti' required></textarea><br>
            <textarea cols='30' rows='15' name='preparation' placeholder='Preparazione' required></textarea><br>
            <input type='submit' value='OK'>
            ";
        }
        ?>

    </form><br><br>
    <form action='showRecipes.php' method='post'>
        <input type='submit' value='<<<'>
    </form>
</body>
</html>