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
<div class="parent-header">
    <div class="header">
        <div class="div-logo">
            <img class="logo" src="../img/background/logo-minecraft.svg" alt="logo-minecraft.svg">
        </div>
    </div>
</div>
    <?php
    $FILE_PATH = '../data/farms.json';
    $JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);

    if (isset($_POST['edit'])) {
        foreach ($JSON_DATA as &$item)
            if ($item['name'] == $_POST['edit']) {
                $item['name'] = $_POST['name'];
                $item['version'] = $_POST['version'];
                $item['rates'] = str_replace("\r\n", "<br>", $_POST['rates']);
                $item['type'] = $_POST['type'];
                $item['overworld'] = $_POST['overworld'];
                $item['nether'] = $_POST['nether'];
                $item['end'] = $_POST['end'];
                $item['tutorial'] = $_POST['tutorial'];
                break;
            }
        file_put_contents($FILE_PATH, json_encode($JSON_DATA, JSON_PRETTY_PRINT));
        header('Location:myFarms.php');
    }
    else {
        if (isset($_POST['overworld']))
            $overworld = $_POST['overworld'];
        else
            $overworld = null;
        if (isset($_POST['nether']))
            $nether = $_POST['nether'];
        else
            $nether = null;
        if (isset($_POST['end']))
            $end = $_POST['end'];
        else
            $end = null;

        $rates = $_POST['rates'];
        $rates = str_replace("\r\n", "<br>", $rates);

        $recipe = array(
            'name' => $_POST['name'],
            'version' => $_POST['version'],
            'rates' => $rates,
            'type' => $_POST['type'],
            'overworld' => $overworld,
            'nether' => $nether,
            'end' => $end,
            'tutorial' => $_POST['tutorial'],
            'owner' => $_COOKIE['user']
        );

        $exists = false;
        foreach ($JSON_DATA as $item)
            if ($item['name'] == $recipe['name']
            && $item['owner'] == $recipe['owner']) {
                $exists = true;
                break;
            }

        if (!$exists) {
            $JSON_DATA[] = $recipe;
            file_put_contents($FILE_PATH, json_encode($JSON_DATA, JSON_PRETTY_PRINT));
            header('Location:myFarms.php');
        } else {
            echo "<h1 class='title' style='padding-top: 5%;'>HAI GIA' CREATO UNA FARM CON QUESTO NOME</h1>
            <br><br><br><br><br><br>
            <div class='parent-container'>
                <a class='ref' href='newFarm.php'>New Farm</a>
            </div>
            ";
        }
    }
    ?>