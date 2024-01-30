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
    require 'Farm.php';

    $FILE_PATH = '../data/farms.json';
    $JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);

    if (isset($_POST['edit-name']) && isset($_POST['edit-owner'])) {
        $object = new Farm(
            $_POST['name'],
            $_POST['version'],
            str_replace("\r\n", "<br>", $_POST['rates']),
            $_POST['type'],
            $_POST['overworld'],
            $_POST['nether'],
            $_POST['end']
        );
        foreach ($JSON_DATA as &$item)
            if ($item['name'] == $_POST['edit-name'] && $item['owner'] == $_POST['edit-owner']) {
                $item['version'] = $object->getName();
                $item['rates'] = $object->getRates();
                $item['type'] = $object->getType();
                $item['overworld'] = $object->getOverworld();
                $item['nether'] = $object->getNether();
                $item['end'] = $object->getEnd();
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

        $object = new Farm(
            $_POST['name'],
            $_POST['version'],
            $rates,
            $_POST['type'],
            $overworld,
            $nether,
            $end
        );
        $farm = array(
            'name' => $object->getName(),
            'version' => $object->getVersion(),
            'rates' => $object->getRates(),
            'type' => $object->getType(),
            'overworld' => $object->getOverworld(),
            'nether' => $object->getNether(),
            'end' => $object->getEnd(),
            'tutorial' => $_POST['tutorial'],
            'owner' => $_COOKIE['user']
        );

        $exists = false;
        foreach ($JSON_DATA as $item)
            if ($item['name'] == $farm['name']
            && $item['owner'] == $_POST['owner']) {
                $exists = true;
                break;
            }

        if (!$exists) {
            $JSON_DATA[] = $farm;
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