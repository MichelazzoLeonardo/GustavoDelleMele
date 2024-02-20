<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Qualcosa è andato storto</title>
    <link rel="icon" href="../img/icon/iron_golem.png">
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
    require 'classes/DB.php';
    require 'classes/Farm.php';
    $conn = DB::getConnection();

    if (isset($_POST['edit-name']) && isset($_POST['edit-owner'])) {
        $name = $_POST['edit-name'];
        $owner = $_POST['edit-owner'];

        $object = new Farm(
            $_POST['name'],
            $_POST['version'],
            str_replace("\r\n", "<br>", $_POST['rates']),
            $_POST['type'],
            $_POST['afkable'],
            $_POST['overworld'],
            $_POST['nether'],
            $_POST['end']
        );
        $tutorial = $_POST['tutorial'];

        $query = "UPDATE farm SET
                    version = '$object->version',
                    rates = '$object->rates',
                    type = '$object->type',
                    afkable = '$object->afkable',
                    overworld = '$object->overworld',
                    nether = '$object->nether',
                    end = '$object->end',
                    tutorial = '$tutorial'
                    WHERE owner = '$owner' AND name = '$name';";

        $farm = $conn->query($query);

        header('Location:myFarms.php');
    }
    else {
        $owner = $_COOKIE['user'];

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
            $_POST['afkable'],
            $overworld,
            $nether,
            $end
        );
        $tutorial = $_POST['tutorial'];

        $query = "SELECT * FROM farm WHERE owner = '$owner' AND name = '$object->getName()';";
        $farm = $conn->query($query);
        $farm->fetch_assoc();

        if ($farm->num_rows == 0) {
            $insert = "INSERT INTO farm(owner, name, version, rates, type, afkable, overworld, nether, end, tutorial)
                        VALUE ('$owner',
                                '$object->name',
                                '$object->version',
                                '$object->rates',
                                '$object->type',
                                '$object->afkable',
                                '$object->overworld',
                                '$object->nether',
                                '$object->end',
                                '$tutorial');";
            try {
                $conn->query($insert);
            } catch (Exception $exception) {
                header("Location:duplicateEntry.php");
                exit();
            }
            header("Location:myFarms.php");
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