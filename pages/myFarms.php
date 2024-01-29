<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Recipes</title>
    <link rel="stylesheet" type="text/css" href="../style/style-main.css">
    <?php
    if(!isset($_COOKIE['user'])) {
        setcookie('page', 'community.php', time() + 86400, '/');
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
        <br>
        <a class='header-button' href='community.php'>HOME</a>
        <?php
        if ($_COOKIE['user'] != 'guest') {
            echo "<a class='header-button' href='logout.php'>LOGOUT</a>";
        }
        ?>
    </div>
</div>
<div class="parent-container">

    <h1 class="title">Le tue farm</h1>
    <br><br><br>

    <?php
    $FILE_PATH = '../data/farms.json';
    $JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);

    if (isset($_POST['remove']))
        foreach ($JSON_DATA as &$farm)
            if ($farm['name'] == $_POST['remove'])
                unset($JSON_DATA[array_search($farm, $JSON_DATA)]);
    file_put_contents($FILE_PATH, json_encode($JSON_DATA, JSON_PRETTY_PRINT));
    $JSON_DATA = json_decode(file_get_contents($FILE_PATH), true);

    if (!empty($JSON_DATA)) {
        foreach ($JSON_DATA as $farm) {
            if ($farm['owner'] == $_COOKIE['user']) {
                echo "
                <div class='container'>
                <p class='name' style='font-weight: bold; font-size: xx-large'>" . $farm['name'] . "</p>
                <div class='internal-div'>
                    <div class='sub-div'>
                        <p class='text'><b>Versione:</b> ".$farm['version']."</p>
                        <p class='text'><b>Produzione:</b> ".$farm['rates']."</p>
                        <a class='text' href='".$farm['tutorial']."' target='_blank'>Tutorial</a>
                    </div>
                </div>
                </div>
                <br><br>
                ";
            }
        }
    } else {
        echo "<p class='subtitle'>Non hai ancora condiviso nessuno dei tuoi capolavori</p><br>";
    }
    ?>
    <div class="parent-container">
        <a class='ref' href='newFarm.php' style="padding: 0 .8% .5% .8%">+</a>
    </div>

</div>
</body>
</html>