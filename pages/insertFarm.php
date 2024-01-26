<?php
$FILE_PATH = '../data/farms.json';
$JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);

if (isset($_POST['edit'])) {
    foreach ($JSON_DATA as &$item)
        if ($item['name'] == $_POST['edit']) {
            $item['name'] = $_POST['name'];
            $item['ingredients'] = $_POST['ingredients'];
            $item['preparation'] = $_POST['preparation'];
            break;
        }
    file_put_contents($FILE_PATH, json_encode($JSON_DATA, JSON_PRETTY_PRINT));
    header('Location:community.php');
}
else {

    $recipe = array(
        'name' => $_POST['name'],
        'ingredients' => $_POST['ingredients'],
        'preparation' => $_POST['preparation'],
        'owner' => $_COOKIE['user']
    );

    $exists = false;
    foreach ($JSON_DATA as $item)
        if ($item['name'] == $recipe['name']) {
            $exists = true;
            break;
        }

    if (!$exists) {
        $JSON_DATA[] = $recipe;
        file_put_contents($FILE_PATH, json_encode($JSON_DATA, JSON_PRETTY_PRINT));
        header('Location:newFarm.php');
    } else {
        echo "UNA RICETTA CON QUESTO NOME ESISTE GIA'<br>
    <form action='newFarm.php' method='post'>
        <input type='submit' value='<<<'>
    </form>";
    }
}