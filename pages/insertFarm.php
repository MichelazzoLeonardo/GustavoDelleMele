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
        <a class='header-button' href='community.php'>HOME</a>
        <?php
        if ($_COOKIE['user'] != 'guest') {
            echo "<a class='header-button' href='myFarms.php'>" . $_COOKIE['user'] . "</a>";
            echo "<a class='header-button' href='logout.php'>LOGOUT</a>";
        }
        if ($_COOKIE['user'] == 'guest')
            echo "<a class='header-button' href='login.php'>LOGIN</a>";
        ?>
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
                $item['rates'] = $_POST['rates'];
                $item['type'] = $_POST['type'];
                $item['overworld'] = $_POST['overworld'];
                $item['nether'] = $_POST['nether'];
                $item['end'] = $_POST['end'];
                $item['tutorial'] = $_POST['tutorial'];
                $item['owner'] = $_COOKIE['user'];
                break;
            }
        file_put_contents($FILE_PATH, json_encode($JSON_DATA, JSON_PRETTY_PRINT));
        header('Location:community.php');
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

        $recipe = array(
            'name' => $_POST['name'],
            'version' => $_POST['version'],
            'rates' => $_POST['rates'],
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
            header('Location:newFarm.php');
        } else {
            echo "<h1 class='title'>HAI GIA' CREATO UNA FARM CON QUESTO NOME</h1><br>";
        }
    }
    ?>