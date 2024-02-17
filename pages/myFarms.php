<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Le tue Farm</title>
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
        <a class='header-button' href='community.php'>HOME</a>
        <?php
        if ($_COOKIE['user'] != 'guest') {
            echo "<a class='header-button' href='logout.php'>LOGOUT</a>";
        }
        ?>
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
    </div>
</div>
<div class="parent-container">
    <h1 class="title" style="padding-top: 5%;">Le tue farm</h1>
    <br><br>

    <?php
    require 'classes/DB.php';

    $conn = DB::getConnection();

    $owner = $_COOKIE['user'];
    $query = "SELECT name, version, rates, tutorial FROM farm WHERE owner = '$owner';";
    $farms = $conn->query($query);

    if ($farms->num_rows > 0) {
        while($row = $farms->fetch_assoc()) {
            if ($row['tutorial'] != "")
                $tutorial = "<a class='ref' style='font-size: x-large' href='" . $row['tutorial'] . "' target='_blank'>Tutorial</a>";
            else $tutorial = "";

            echo "
            <div class='container'>
            <p class='name' style='font-weight: bold; font-size: xx-large'>" . $row['name'] . "</p>
                <div class='internal-div'>
                    <div class='sub-div'>
                        <p class='text'><b>Versione:</b> " . $row['version'] . "</p>
                        <p class='text'><b>Produzione:</b><br>" . $row['rates'] . "</p>
                        " . $tutorial . "
                        <form action='removeFarm.php' method='post' style='float: right'>
                            <input type='hidden' name='remove-name' value='" . $row['name'] . "'>
                            <input type='hidden' name='remove-owner' value='" . $owner . "'>
                            <input class='farm-button remove' type='submit' value='R'>
                        </form>
                        <form action='newFarm.php' method='post' style='float: right'>
                            <input type='hidden' name='edit-name' value='" . $row['name'] . "'>
                            <input type='hidden' name='edit-owner' value='" . $owner . "'>
                            <input class='farm-button edit' type='submit' value='E'>
                        </form>
                    </div>
                </div>
            </div>
            <br><br>
            ";
        }
    } else {
        echo "<p class='subtitle'>Non hai ancora condiviso nessuno dei tuoi capolavori</p><br>";
    }
    ?>
    <div class="parent-container">
        <a class='ref' href='newFarm.php' style="padding: 0 .8% .5% .8%">+</a>
    </div>
    <br><br><br>
</div>
</body>
</html>