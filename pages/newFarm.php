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
                echo "
                
                <form action='insertFarm.php' method='post'>
                    <input type='hidden' name='edit' value='".$_POST['edit']."'>
                    <input class='input' type='text' name='name' value='" . $r['name'] . "' required autofocus><br>
                    <input class='input' type='text' name='version' value='" . $r['version'] . "'><br>
                    <textarea class='input' cols='30' rows='5' name='production' required>" . $r['production'] . "</textarea><br>
                    <textarea class='input' cols='30' rows='5' name='rates' required>" . $r['rates'] . "</textarea><br>
                    <label class='label'><b>Tipo di farm:</b><br>
                        Mob<input type='radio' name='type' value='mob' required "; if ($r['type'] == 'mob') echo "checked"; echo">&nbsp;
                        Block<input type='radio' name='type' value='block' required "; if ($r['type'] == 'block') echo "checked"; echo">&nbsp;
                        Item<input type='radio' name='type' value='item' required "; if ($r['type'] == 'item') echo "checked"; echo"><br>
                    </label>
                    <label class='label'><b>Dimensione:</b><br>
                        Overworld<input type='checkbox' name='overworld' value='overworld' "; if ($r['overworld'] == 'overworld') echo "checked"; echo">&nbsp;
                        Nether<input type='checkbox' name='nether' value='nether' "; if ($r['nether'] == 'nether') echo "checked"; echo">&nbsp;
                        End<input type='checkbox' name='end' value='end' "; if ($r['end'] == 'end') echo "checked"; echo"><br>
                    </label>
                    <input class='button' type='submit' value='OK'>
                </form>
            ";
            } else {
                echo "
                <form action='insertFarm.php' method='post'>
                    <input class='input' type='text' name='name' placeholder='Nome della farm' required autofocus><br>
                    <input class='input' type='text' name='version' placeholder='versione'><br>
                    <textarea class='input' cols='30' rows='5' name='production' placeholder='item prodotti' required></textarea><br>
                    <textarea class='input' cols='30' rows='5' name='rates' placeholder='item/h' required></textarea><br>
                    <label class='label'><b>Tipo di farm:</b><br>
                        Mob<input type='radio' name='type' value='mob' required>&nbsp;
                        Block<input type='radio' name='type' value='block' required>&nbsp;
                        Item<input type='radio' name='type' value='item' required><br>
                    </label>
                    <label class='label'><b>Dimensione:</b><br>
                        Overworld<input type='checkbox' name='overworld' value='overworld' checked>&nbsp;
                        Nether<input type='checkbox' name='nether' value='nether'>&nbsp;
                        End<input type='checkbox' name='end' value='end'><br>
                    </label>
                    <input class='button' type='submit' value='OK'>
                </form>
            ";
            }
        }
        ?>
</body>
</html>