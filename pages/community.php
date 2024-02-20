<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Home</title>
    <link rel="icon" href="../img/icon/minecraft_java.png">
    <link rel="stylesheet" type="text/css" href="../style/style-main.css">
    <?php
    if(!isset($_COOKIE['user'])) {
        setcookie('page', 'community.php', time() + 86400, '/');
        header('Location:login.php');
    }
    if(isset($_POST['filter'])) {
        if($_POST['filter'] == 'ASC')
            $orderby = 'DESC';
        else $orderby = 'ASC';
    } else $orderby = $_COOKIE['orderby'];
    ?>
</head>
<body>
<div class="parent-header">
    <div class="header">
        <div class="div-logo">
            <img class="logo" src="../img/background/logo-minecraft.svg" alt="logo-minecraft.svg">
        </div>
        <br>
        <div class="header-buttons">
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
        <div class="parent-div-search">
            <div class="div-search">
                <form style="float: left; width: 87%; text-align: left" action="community.php" method="post">
                    <input class="search-bar" type="search" name="search"
                        <?php
                        if (isset($_POST['search']) && $_POST['search'] != '') echo "value='".$_POST['search']."'";
                        else echo "placeholder='search a farm'";
                        ?>>
                    <input class="search-button" type="submit" value="-">
                </form>
                <form action="community.php" method="post">
                    <input type="hidden" name="search" value="<?php
                        if (isset($_POST['search'])) echo $_POST['search'];
                        else echo '';
                        ?>">
                    <input type="hidden" name="filter" value="<?php echo $orderby ?>">
                    <input class="filter" type="submit" value="-">
                </form>
            </div>
        </div>

        <!---
        <form style="float: left; width: 87%; text-align: right" action="community.php" method="post">
                    <input class="search-bar" type="search" name="search"
                        <?php /*
        if (isset($_POST['search']) && $_POST['search'] != '') echo "value='".$_POST['search']."'";
        else echo "placeholder='search a farm'";*/
        ?>>
                    <input class="search-button" type="submit" value="-">
                </form>
                <form action="community.php" method="post">
                    <input type="hidden" name="filter" value="<?php //echo $_COOKIE['orderby']; ?>">
                    <input class="filter" type="submit" value="-">
                </form>


                <form action="community.php" method="post">
                    <input class="search-bar" type="search" name="search"
                        <?php /*
        if (isset($_POST['search']) && $_POST['search'] != '') echo "value='".$_POST['search']."'";
        else echo "placeholder='search a farm'";
        */?>>
                    <input class="search-button" type="submit" value="-">
                    <input class="filter" name="filter" type="submit" value="-">
                </form>
        --->

    </div>
</div>


<div class="parent-container">
    <h1 class="title" style="padding-top: 5%;">COMMUNITY</h1>
    <br><br>

    <?php
    require 'classes/DB.php';

    $conn = DB::getConnection();

    if (isset($_POST['search'])) {
        $searched = $_POST['search'];
        $query = "SELECT DISTINCT name, version, rates, tutorial FROM farm
                    WHERE name LIKE '%$searched%'
                    ORDER BY name $orderby;";
        $farms = $conn->query($query);

        if ($farms->num_rows > 0) {
            while ($row = $farms->fetch_assoc()) {
                if ($row['tutorial'] != "")
                    $tutorial = "<a class='ref' style='font-size: x-large' href='" . $row['tutorial'] . "' target='_blank'>Tutorial</a>";
                else $tutorial = '';

                echo "
            <div class='container'>
            <p class='name' style='font-weight: bold; font-size: xx-large'>" . $row['name'] . "</p>
            <div class='internal-div'>
                <div class='sub-div'>
                    <p class='text'><b>Versione:</b> " . $row['version'] . "</p>
                    <p class='text'><b>Produzione:</b><br>" . $row['rates'] . "</p>
                    " . $tutorial . "
                </div>
            </div>
            </div>
            <br><br>
            ";
            }
        }

        $query = "SELECT DISTINCT name, version, rates, tutorial FROM farm
                    WHERE rates LIKE '%$searched%' AND name NOT LIKE '%$searched%'
                    ORDER BY name $orderby;";
        $farms = $conn->query($query);

        if ($farms->num_rows > 0) {
            while ($row = $farms->fetch_assoc()) {
                if ($row['tutorial'] != "")
                    $tutorial = "<a class='ref' style='font-size: x-large' href='" . $row['tutorial'] . "' target='_blank'>Tutorial</a>";
                else $tutorial = '';

                echo "
            <div class='container'>
            <p class='name' style='font-weight: bold; font-size: xx-large'>" . $row['name'] . "</p>
            <div class='internal-div'>
                <div class='sub-div'>
                    <p class='text'><b>Versione:</b> " . $row['version'] . "</p>
                    <p class='text'><b>Produzione:</b><br>" . $row['rates'] . "</p>
                    " . $tutorial . "
                </div>
            </div>
            </div>
            <br><br>
            ";
            }
        }
    }
    elseif (!isset($_POST['search'])) {
        $query = "SELECT name, version, rates, tutorial FROM farm ORDER BY name $orderby;";
        $farms = $conn->query($query);

        if ($farms->num_rows > 0) {
            while ($row = $farms->fetch_assoc()) {
                if ($row['tutorial'] != "")
                    $tutorial = "<a class='ref' style='font-size: x-large' href='" . $row['tutorial'] . "' target='_blank'>Tutorial</a>";
                else $tutorial = '';

                echo "
            <div class='container'>
            <p class='name' style='font-weight: bold; font-size: xx-large'>" . $row['name'] . "</p>
            <div class='internal-div'>
                <div class='sub-div'>
                    <p class='text'><b>Versione:</b> " . $row['version'] . "</p>
                    <p class='text'><b>Produzione:</b><br>" . $row['rates'] . "</p>
                    " . $tutorial . "
                </div>
            </div>
            </div>
            <br><br>
            ";
            }
        }
    } else {
        echo "<h3 class='title'>Wow, such empty</h3>";
    }
    ?>
</div>
<div class="credits-container">
    <div class="credits-images">
        <img style="width: 15%; padding: 2%" src="../img/logo/mojang.png" alt="mojang.png">
        <img style="width: 20%; padding: 2% 2% 3% 2%" src="../img/logo/xbox.png" alt="xbox.png">
        <img style="width: 40%; padding: 2% 2% 5% 2%" src="../img/icon/logo-minecraft.svg" alt="minecraft.png">
    </div>
    <table class="credits-table">
        <tr>
            <th>CONTATTI</th>
            <th style="color: transparent">
                _________
            </th>
            <th>SOCIAL</th>
        </tr>
        <tr>
            <td>
                <p class="credits"><b>Author: </b>Michelazzo Leonardo</p>
                <p class="credits"><b>Email: </b><a class="credits-ref" href="mailto:webmaster@example.com">myEmail <img src="../img/icon/mailto.svg" alt="share.svg"></a></p>
                <p class="credits"><b>GitHub: </b><a class="credits-ref" href="https://github.com/MichelazzoLeonardo/MinecraftFarmsCommunity" target="_blank">Project Repository <img src="../img/icon/mailto.svg" alt="share.svg"></a></p>
            </td>
            <td style="color: transparent">
                _________
            </td>
            <td>
                <p class="credits">
                    <a class="credits-ref" target="_blank" href="https://www.instagram.com/minecraft/">
                        Instgram <img src="../img/icon/mailto.svg" alt="share.svg"></a></p>
                <p class="credits">
                    <a class="credits-ref" target="_blank" href="https://www.reddit.com/r/Minecraft/?rdt=48290&onetap_auto=true&one_tap=true">
                        
                        Reddit <img src="../img/icon/mailto.svg" alt="share.svg"></a></p>
                <p class="credits">
                    <a class="credits-ref" target="_blank" href="https://www.youtube.com/minecraft">
                        
                        Youtube <img src="../img/icon/mailto.svg" alt="share.svg"></a></p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
