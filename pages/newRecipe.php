<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Add Recipe</title>
</head>
<body><?php
if(isset($_COOKIE['user']))
    echo"
    <form action='addRecipe.php' method='post'>
        <input type='text' name='name' placeholder='Nome della ricetta' required autofocus><br>
        <textarea cols='30' rows='5' name='ingredients' placeholder='Ingredienti' required></textarea><br>
        <textarea cols='30' rows='15' name='preparation' placeholder='Preparazione' required></textarea><br>
        <input type='submit' value='OK'>
    </form><br><br>
    <form action='showRecipes.php' method='post'>
        <input type='submit' value='<<<'>
    </form>";
else
    echo "non sei registrato<br>
    <form action='showRecipes.php' method='post'>
        <input type='submit' value='<<<'>
    </form>
    "
?>
</body>
</html>