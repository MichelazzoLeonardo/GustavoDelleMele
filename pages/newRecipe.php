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
        <input type='text' name='name' placeholder='Nome della ricetta' required autofocus><br>
        <textarea cols='30' rows='5' name='ingredients' placeholder='Ingredienti' required></textarea><br>
        <textarea cols='30' rows='15' name='preparation' placeholder='Preparazione' required></textarea><br>
        <input type='submit' value='OK'>
    </form><br><br>
    <form action='showRecipes.php' method='post'>
        <input type='submit' value='<<<'>
    </form>
</body>
</html>