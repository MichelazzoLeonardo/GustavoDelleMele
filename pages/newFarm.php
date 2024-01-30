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
            if (isset($_POST['edit-name']) && isset($_POST['edit-owner'])) {

                $farms = json_decode(file_get_contents("../data/farms.json"), true);
                $farm = null;
                foreach ($farms as $f)
                    if ($f['name'] == $_POST['edit-name'] && $f['owner'] == $_POST['edit-owner']) {
                        $farm = $f;
                        break;
                    }

                $required = '';
                $name = 'value=\''.$farm['name'].'\'';
                $version = 'value=\''.$farm['version'].'\'';
                $rates = '>'.str_replace("<br>", "\r\n", $farm['rates']);

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

                $tutorial = 'value=\''.$farm['tutorial'].'\'';

            } else {
                $required = 'required';
                $name = 'placeholder=\'Nome della farm\' autofocus';
                $version = 'placeholder=\'Versione\'';
                $rates = 'placeholder=\'Item/h\' required>';
                $mob = 'checked';
                $block = '';
                $item = '';
                $overworld = 'checked';
                $nether = '';
                $end = '';
                $tutorial = 'placeholder=\'link del tutorial (opzionale)\'';
            }
        }
        ?>

<h1 class="title" style="padding-top: 5%;"></h1>
<br><br>
<div class="container">
    <form action='insertFarm.php' method='post'>
        <?php
        if (isset($_POST['edit-name']) && isset($_POST['edit-owner'])) {
            echo "<input type='hidden' name='edit-name' value='" . $_POST['edit-name'] . "'>";
            echo "<input type='hidden' name='edit-owner' value='" . $_POST['edit-owner'] . "'>";
        }
        ?>
    <input class='input-title' type='text' name='name' <?php echo $name.' '.$required?>>
    <div class="internal-div">
        <div class="sub-div">
                <input class='input' type='text' name='version' <?php echo $version.'\' '.$required ?>'><br>
                <textarea class='input' cols='30' rows='3' name='rates' <?php echo $rates ?></textarea><br>
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
                <input class='input' type='url' name='tutorial' style='font-size: medium; width: 100%' <?php echo $tutorial ?>'>
                <br>
                <input class='ref' type='submit' value='✓' style="padding: 0 2% 0 2%">
        </div>
    </div>
</form>
</div>
</body>
</html>