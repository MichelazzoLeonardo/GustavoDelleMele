<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Add Farm</title>
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
                require 'classes/DB.php';
                $name = $_POST['edit-name'];
                $owner = $_POST['edit-owner'];

                $conn = DB::getConnection();

                $query = "SELECT * FROM farm WHERE owner = '$owner' AND name = '$name';";
                $farm = $conn->query($query);
                $row = $farm->fetch_assoc();

                $required = '';
                $name = 'value=\''.$row['name'].'\' readonly';
                $version = 'value=\''.$row['version'].'\'';
                $rates = '>'.str_replace("<br>", "\r\n", $row['rates']);

                if ($row['type'] == 'mob')
                    $mob = 'checked';
                else $mob = '';

                if ($row['type'] == 'block')
                    $block = 'checked';
                else $block = '';

                if ($row['type'] == 'item')
                    $item = 'checked';
                else $item = '';

                if ($row['overworld'] == 'overworld')
                    $overworld = 'checked';
                else $overworld = '';

                if ($row['nether'] == 'nether')
                    $nether = 'checked';
                else $nether = '';

                if ($row['end'] == 'end')
                    $end = 'checked';
                else $end = '';

                $tutorial = 'value=\''.$row['tutorial'].'\'';

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
    <input class='input-title' type='text' name='name' <?php echo $name.' '.$required?> aria-valuemax="64">
    <div class="internal-div">
        <div class="sub-div">
                <input class='input' type='text' name='version' <?php echo $version.'\' '.$required ?> aria-valuemax="64"><br>
                <textarea class='input' cols='30' rows='3' name='rates' <?php echo $rates ?></textarea><br>
                <label class='label'><b>Tipo di farm:</b><br>
                    Mob<input type='radio' name='type' value='mob' <?php echo $mob.' '.$required ?>>&nbsp;
                    Block<input type='radio' name='type' value='block' <?php echo $block.' '.$required ?>><br>
                    Automatica<input type='radio' name='afkable' value='automatic' <?php echo $mob.' '.$required ?>>
                    Manuale<input type='radio' name='afkable' value='manual' <?php echo $block.' '.$required ?>><br>
                </label>
                <label class='label'><b>Dimensione:</b><br>
                    <img class='icon' src='../img/icon/overworld.png' alt='overworld.png'>
                    <input type='checkbox' name='overworld' value='overworld' <?php echo $overworld ?>>&nbsp;
                    <img class='icon' src='../img/icon/nether.gif' alt='nether.png'>
                    <input type='checkbox' name='nether' value='nether' <?php echo $nether ?>>&nbsp;
                    <img class='icon' src='../img/icon/end.png' alt='end.png'>
                    <input type='checkbox' name='end' value='end' <?php echo $end ?>><br>
                </label>
                <input class='input' type='url' name='tutorial' style='font-size: medium; width: 100%' <?php echo $tutorial ?>  aria-valuemax="200">
                <br>
                <input class='ref' type='submit' value='✓' style="padding: 0 2% 0 2%">
        </div>
    </div>
</form>
</div>
</body>
</html>