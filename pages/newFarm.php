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
                $production = $farm['production'];
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
                $production = 'Item prodotti';
                $rates = 'Numero di item/h';
                $mob = 'checked';
                $block = '';
                $item = '';
                $overworld = 'checked';
                $nether = '';
                $end = '';
            }
        }
        ?>


<form action='insertFarm.php' method='post'>
    <input class='input' type='text' name='name' placeholder='<?php echo $name.'\' '.$required?>' autofocus><br>
    <input class='input' type='text' name='version' placeholder='<?php echo $version.'\' '.$required ?>'><br>
    <textarea class='input' cols='30' rows='5' name='production' placeholder='<?php echo $production.'\' '.$required ?>'></textarea><br>
    <textarea class='input' cols='30' rows='5' name='rates' placeholder='<?php echo $rates.'\' '.$required ?>'></textarea><br>
    <label class='label'><b>Tipo di farm:</b><br>
        Mob<input type='radio' name='type' value='mob' <?php echo $mob.' '.$required ?>>&nbsp;
        Block<input type='radio' name='type' value='block' <?php echo $block.' '.$required ?>>&nbsp;
        Item<input type='radio' name='type' value='item' <?php echo $item.' '.$required ?>><br>
    </label>
    <label class='label'><b>Dimensione:</b><br>
        <img class='icon' src='../img/overworld.png' alt='overworld.png'>
        <input type='checkbox' name='overworld' value='overworld' <?php echo $overworld ?>>&nbsp;
        <img class='icon' src='../img/nether.gif' alt='nether.png'>
        <input type='checkbox' name='nether' value='nether' <?php echo $nether ?>>&nbsp;
        <img class='icon' src='../img/end.png' alt='end.png'>
        <input type='checkbox' name='end' value='end' <?php echo $end ?>><br>
    </label>
    <input class='button' type='submit' value='OK'>
</form>
</body>
</html>