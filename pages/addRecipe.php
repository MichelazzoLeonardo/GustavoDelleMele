<?php
$FILE_PATH = '../data/recipes.json';
$JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);

$recipe = array(
    'name' => $_POST['name'],
    'ingredients' => $_POST['ingredients'],
    'preparation' => $_POST['preparation']
);

$exists = false;
foreach ($JSON_DATA as $item)
    if ($item['name'] == $recipe['name']) {
        $exists = true;
        break;
    }

if(!$exists) {
    $JSON_DATA[] = $recipe;
    file_put_contents($FILE_PATH, json_encode($JSON_DATA, JSON_PRETTY_PRINT));
    header('Location:newRecipe.php');
} else {
    echo "UNA RICETTA CON QUESTO NOME ESISTE GIA'<br>
    <form action='newRecipe.php' method='post'>
        <input type='submit' value='<<<'>
    </form>";
}