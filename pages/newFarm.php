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
        <br>
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
        if($_COOKIE['user'] == 'guest') {
            echo "<h1 class='title'>Utente non riconosciuto</h1>";
            setcookie('page', 'newFarm.php', time() + 86400, '/');
        }
        else {
            if (isset($_POST['edit'])) {

                $farms = json_decode(file_get_contents("../data/farms.json"), true);
                $farm = null;
                foreach ($farms as $r)
                    if ($r['name'] == $_POST['edit']) {
                        $farm = $r;
                        break;
                    }

                $required = '';
                $name = $farm['name'];
                $version = $farm['version'];
                $rates = $farm['rates'];

                if ($farm['type'] == 'mob')
                    $mob = 'checked';
                else $mob = '';

                if ($farm['type'] == 'block')
                    $block = 'checked';
                else $block = '';

                if ($farm['type'] == 'item')
                    $item = 'checked';
                else $item = '';

                if ($farm['overworld'] == 'overworld')
                    $overworld = 'checked';
                else $overworld = '';

                if ($farm['nether'] == 'nether')
                    $nether = 'checked';
                else $nether = '';

                if ($farm['end'] == 'end')
                    $end = 'checked';
                else $end = '';

            } else {
                $required = 'required';
                $name = 'Nome della farm';
                $version = 'Versione';
                $rates = 'Item/h';
                $mob = 'checked';
                $block = '';
                $item = '';
                $overworld = 'checked';
                $nether = '';
                $end = '';
                $tutorial = 'link del tutorial (opzionale)';
            }
        }
        ?>

<div class="container">
    <form action='insertFarm.php' method='post'>
    <input class='input-title' type='text' name='name' placeholder='<?php echo $name.'\' '.$required?>' autofocus>
    <div class="internal-div">
        <div class="sub-div">
                <input class='input' type='text' name='version' placeholder='<?php echo $version.'\' '.$required ?>'><br>
                <textarea class='input' cols='30' rows='3' name='rates' placeholder='<?php echo $rates.'\' '.$required ?>'></textarea><br>
                <label class='label'><b>Tipo di farm:</b><br>
                    Mob<input type='radio' name='type' value='mob' <?php echo $mob.' '.$required ?>>&nbsp;
                    Block<input type='radio' name='type' value='block' <?php echo $block.' '.$required ?>>&nbsp;
                    Item<input type='radio' name='type' value='item' <?php echo $item.' '.$required ?>><br>
                </label>
                <label class='label'><b>Dimensione:</b><br>
                    <img class='icon' src='../img/icon/overworld.png' alt='overworld.png'>
                    <input type='checkbox' name='overworld' value='overworld' <?php echo $overworld ?>>&nbsp;
                    <img class='icon' src='../img/icon/nether.gif' alt='nether.png'>
                    <input type='checkbox' name='nether' value='nether' <?php echo $nether ?>>&nbsp;
                    <img class='icon' src='../img/icon/end.png' alt='end.png'>
                    <input type='checkbox' name='end' value='end' <?php echo $end ?>><br>
                </label>
                <input class='input' type='url' name='tutorial' style='font-size: medium; width: 100%' placeholder='<?php echo $tutorial ?>'>
                <br>
                <input class='ref' type='submit' value='✓' style="padding: 0 2% 0 2%">
            </form>
        </div>
    </div>
</div>
</body>
</html>